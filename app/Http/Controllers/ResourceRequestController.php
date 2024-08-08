<?php

namespace App\Http\Controllers;

use App\Mail\ResourceCreated;
use App\Events\ResourceScheduleCreated;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use DateInterval;
use DatePeriod;
use DateTime;
use App\Models\Activity;
use App\Models\Resource;
use DB;
use App\Models\Location;
use Carbon\Carbon;
use Auth;



class ResourceRequestController extends Controller
{
    //
    public function requestview()
    {
        $activities = Activity::all()->sortBy(function ($activities) {
            return $activities->activity_name;
        });
        $locations = Location::all()->sortBy(function ($locations) {
            return $locations->location;
        });
        $clas = Grade::all()->sortBy(function ($clas) {
            return $clas->class_name;
        });
        $persons = User::all()->sortBy(function ($person) {
            return $person->name;
        });
        // $supervisor = Auth::user()->
        return view('resourceRequest')->with('activities', $activities)
            ->with('locations', $locations)
            ->with('clas', $clas)
            ->with('persons', $persons);
    }
    public function storeResource(Request $request)
    {
        // Validate the request data
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'persons' => 'required|array',
            'persons.*' => 'integer',
            'day' => 'required|array',
            'activity' => 'required|integer',
            'location' => 'required|integer',
            'remarks' => 'string|nullable',
        ]);
        if (!$request->has('persons') || empty($request->persons)) {
            $error = 'Please select at least one person.';
            return redirect()->back()->with('error', $error)->withInput();
        }

        $begin = new DateTime($request->start_date);
        $end = new DateTime($request->end_date);
        $end->setTime(0, 0, 1);
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);

        // Loop through each selected person
        foreach ($request->input('persons') as $selectedPersonId) {
            foreach ($period as $dt) {
                if (in_array($dt->format('l'), $request->day)) {
                    $startDate = Carbon::parse($dt);

                    $startTime = Carbon::createFromFormat('H:i', $request->start_time);
                    $endTime = Carbon::createFromFormat('H:i', $request->end_time);
                    $eightAM = Carbon::createFromFormat('H:i', '08:00');
                    $threePM = Carbon::createFromFormat('H:i', '15:00');

                    if ($startTime >= $eightAM && $endTime <= $threePM) {
                        // Validation for time between 8 AM and 3 PM
                        $locationId = $request->location;

                        // Check for conflicting schedules within the specified time frame
                        $existingSchedule = Resource::where('location_id', $locationId)
                            ->where('date', $startDate)
                            ->where(function ($query) use ($startTime, $endTime) {
                                $query->whereBetween('time_from', [$startTime, $endTime])
                                    ->orWhereBetween('time_to', [$startTime, $endTime])
                                    ->orWhere(function ($query) use ($startTime, $endTime) {
                                        $query->where('time_from', '<', $startTime)
                                            ->where('time_to', '>', $endTime);
                                    });
                            })
                            ->first();

                        if ($existingSchedule) {
                            return redirect()->back()->with('error', 'Location is already booked for ' . $existingSchedule->user->name . ' at this date and time.');
                        }
                    } else {
                        // If the time frame is outside 8 AM - 3 PM, handle accordingly (e.g., show error or set a default value)
                        return redirect()->back()->with('error', 'The time frame should be between 8 AM and 3 PM.');
                    }

                    // Create a new schedule for the current person
                    $data = new Resource();
                    $data->date = $startDate;
                    $data->time_from = $request->start_time;
                    $data->time_to = $request->end_time;
                    $data->day = $dt->format('l');
                    $data->user_id = $selectedPersonId;
                    $data->department = Auth::user()->dep_id;
                    $data->class_id = $request->class;
                    $data->activity_id = $request->activity;
                    $data->location_id = $locationId;
                    $data->remarks = $request->remarks;
                    $data->save();

                }
            }
        }
        Mail::to('nida.ismail@imdcollege.edu.pk')->send(new ResourceCreated($request->all()));

        return redirect()->back()->with('success', 'Schedule added Successfully');
    }
    public function checkResourceAvailability(Request $request)
    {
        $locationId = $request->input('location_id');
        $startDate = Carbon::createFromFormat('Y-m-d', $request->input('start_date'));
        $endDate = Carbon::createFromFormat('Y-m-d', $request->input('end_date'));
        $startTime = Carbon::createFromFormat('H:i:s', $request->input('start_time'));
        $endTime = Carbon::createFromFormat('H:i:s', $request->input('end_time'));

        $isLocationAvailable = Resource::where('location_id', $locationId)
            ->where(function ($query) use ($startDate, $endDate, $startTime, $endTime) {
                $query->whereBetween('date', [$startDate, $endDate]);
            })
            ->orWhere(function ($query) use ($startTime, $endTime) {
                $query->whereTime('time_from', '<', $endTime)
                    ->whereTime('time_to', '>', $startTime);

            })->get();// query database to check if the location is available during the specified time frame

        if ($isLocationAvailable) {
            return response()->json(['success' => 'Location is available']);
        } else {
            return response()->json(['error' => 'Location is already booked']);
        }
    }

}
