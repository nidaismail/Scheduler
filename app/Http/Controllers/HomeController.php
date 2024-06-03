<?php
namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\User;
use App\Models\Schedule;
use DateInterval;
use DatePeriod;
use DateTime;
use App\Models\Activity;
use DB;
use App\Models\Location;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $activities = Activity::all()->sortBy(function ($activities) {
            return $activities->activity_name;
        });
        $defaultActivityId = 3;
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
        return view('admin.home')->with('activities', $activities)
            ->with('locations', $locations)
            ->with('clas', $clas)
            ->with('persons', $persons)
            ->with('defaultActivityId', $defaultActivityId);
    }
    public function userindex()
    {
        $persons = User::all()->sortBy(function ($person) {
            return $person->name;
        });
        $user = Auth::user();
        return view('userHome', compact('user', 'persons'));
    }

    public function store(Request $request)
    {
        try {
            $selectedPersonIds = $request->input('persons', []);
            // Check if at least one person is selected
            if (empty($selectedPersonIds)) {
                $error = 'Please select at least one person.';
                return redirect()->back()->with('error', $error)->withInput();
            }
            $selectedClass = $request->input('class');
            if (empty($selectedClass)) {
                $error = 'Please select a class.';
                return redirect()->back()->with('error', $error)->withInput();
            }
            // Validate the request data
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'persons' => 'required|array',
                'persons.*' => 'integer',
                'class' => 'required',
                'day' => 'required|array',
                'activity' => 'required|integer',
                'location' => 'required|integer',
                'remarks' => 'string|nullable',
            ]);
            // Prepare schedule data
            $startDate = new DateTime($request->start_date);
            $endDate = new DateTime($request->end_date);
            $endDate->modify('+1 day'); // Include end date in the period
            $interval = new DateInterval('P1D');
            $period = new DatePeriod($startDate, $interval, $endDate);

            $startTime = Carbon::createFromFormat('H:i', $request->start_time);
            $endTime = Carbon::createFromFormat('H:i', $request->end_time);
            $eightAM = Carbon::createFromFormat('H:i', '08:00');
            $threePM = Carbon::createFromFormat('H:i', '15:00');

            // Check for conflicting schedules for the given time frame and location
            foreach ($period as $date) {
                if (in_array($date->format('l'), $request->day)) {
                    // Check time frame
                    if ($startTime >= $eightAM && $endTime <= $threePM) {
                        // Validation for time between 8 AM and 3 PM
                        $locationId = $request->location;

                        // Check for conflicting schedules
                        $existingSchedules = Schedule::where('location_id', $locationId)
                            ->where('date', $date->format('Y-m-d'))
                            ->where('admissible', 0)
                            ->where(function ($query) use ($startTime, $endTime) {
                                $query->whereBetween('time_from', [$startTime, $endTime])
                                    ->orWhereBetween('time_to', [$startTime, $endTime])
                                    ->orWhere(function ($query) use ($startTime, $endTime) {
                                        $query->where('time_from', '<', $startTime)
                                            ->where('time_to', '>', $endTime);
                                    });
                            })
                            ->exists();

                        if ($existingSchedules) {
                            return redirect()->back()->with('error', 'Location is already booked for the selected time frame.')->withInput();
                        }
                    } else {
                        // If the time frame is outside 8 AM - 3 PM, handle accordingly (e.g., show error or set a default value)
                        return redirect()->back()->with('error', 'The time frame should be between 8 AM and 3 PM.')->withInput();
                    }
                }
            }

            // If no conflicting schedules, proceed to create schedules for all selected persons
            foreach ($selectedPersonIds as $selectedPersonId) {
                foreach ($period as $date) {
                    if (in_array($date->format('l'), $request->day)) {
                        // Create a new schedule for the current person
                        $data = new Schedule();
                        $data->date = $date;
                        $data->time_from = $request->start_time;
                        $data->time_to = $request->end_time;
                        $data->day = $date->format('l');
                        $data->user_id = $selectedPersonId;
                        $data->department = Auth::user()->dep_id;
                        $data->class_id = $request->class;
                        $data->activity_id = $request->activity;
                        $data->location_id = $request->location;
                        $data->remarks = $request->remarks;
                        $data->save();
                    }
                }
            }

            return redirect()->back()->with('success', 'Schedule added Successfully');
        } catch (QueryException $e) {
            // If there's an error with the database query
            return redirect()->back()->with('error', 'Failed to save schedule. Please try again later.');
        } catch (\Exception $e) {
            // If there's any other unexpected error
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
        }
    }
    public function checkLocationAvailability(Request $request)
    {
        $locationId = $request->input('location_id');
        $startDate = Carbon::createFromFormat('Y-m-d', $request->input('start_date'));
        $endDate = Carbon::createFromFormat('Y-m-d', $request->input('end_date'));
        $startTime = Carbon::createFromFormat('H:i:s', $request->input('start_time'));
        $endTime = Carbon::createFromFormat('H:i:s', $request->input('end_time'));

        $isLocationAvailable = Schedule::where('location_id', $locationId)
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



    // public function checkSchedule(Request $request)
    // {
    //   $location = $request->input('location');
    //   $timeFrom = $request->input('timeFrom');
    //   $timeTo = $request->input('timeTo');

    //   $scheduleCount = Schedule::where('location', $location)
    //                             ->where('time_from', $timeFrom)
    //                             ->where('time_to', $timeTo)
    //                             ->count();

    //   if ($scheduleCount > 0) {
    //     return response()->json(['available' => false]);
    //   } else {
    //     return response()->json(['available' => true]);
    //   }
    // }

    // public function check(Request $request)
    // {
    //     $selectedValue = $request->location_id;
    //     $dateFrom = $request->dateFrom;
    //     $dateTo = $request->dateTo;
    //     $timeFrom= $request->timeFrom;
    //     $timeTo= $request->timeTo;
    //     $existingrecod = DB::table('Schedule')
    //                              ->where('location_id',[$selectedValue])
    //                              ->whereBetween('date', [$dateFrom, $dateTo])
    //                              ->where('time_from',[$timeFrom])
    //                              ->where('time_to',[$timeTo])
    //                              ->get();
    //     return response()->json(['success' => true]);

    // }



    public function displayActivity(Request $request)
    {
        $data = Schedule::where('id', '>=', 1)->with(['person'])->get()->toArray();
        echo "<pre>";
        print_r($data);

    }

}