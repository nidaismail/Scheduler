<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Grade;
use App\Models\Schedule;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\User;

class MutableController extends Controller
{
    public function mute(Request $request)
    {
        //$classId = $request->input('class');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $selectedLocation = $request->input('location'); // Retrieve selected location ID
        $selectedClass = $request->input('class'); // Retrieve selected class ID

        // Fetch schedules based on the selected class, date range, and location
        $schedulesQuery = Schedule::with(['user', 'activity', 'class', 'location'])
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')
            ->orderBy('time_from');

        // Check if a location is selected
        if (!empty($selectedLocation)) {
            $schedulesQuery->where('location_id', $selectedLocation);
        }

        // Check if a class is selected
        if (!empty($selectedClass)) {

            $schedulesQuery->where('class_id', '=', $selectedClass);

        }

        // Fetch schedules based on the modified query
        $schedules = $schedulesQuery->get();


        $locations = Location::all()->sortBy('location');
        $classes = Grade::all()->sortBy('class');
        $users = User::all()->sortBy('user');
        $activities = Schedule::all()->sortBy('activity');

        // Pass the schedules to the view
        return view('admin.mutable', compact('schedules', 'locations', 'users', 'classes', 'activities'));
    }

    // public function editSelected(Request $request)
    // {

    //     $selectedIds = explode(',', $request->ids);
    //     // Retrieve the selected schedules based on the IDs
    //     $schedules = Schedule::whereIn('id', $selectedIds)->get();
    //     $users = User::all();
    //     return view('admin.edit_schedules', compact('schedules', 'selectedIds', 'users'));
    // }
    // public function update(Request $request)
    // {
    //     // Check if schedule IDs are provided
    //     if (!$request->has('selected_ids')) {
    //         return redirect()->back()->with('error', 'No schedule IDs provided.');
    //     }

    //     // Get the selected schedule IDs
    //     $selectedIds = explode(',', $request->selected_ids);

    //     // Check if any schedule IDs are provided
    //     if (empty($selectedIds)) {
    //         return redirect()->back()->with('error', 'No schedule IDs provided.');
    //     }

    //     // Validate the form data
    //     $validatedData = $request->validate([
    //         'user_id' => 'required|array|min:1', // At least one person must be selected
    //         // Other validation rules...
    //     ]);

    //     // Check if at least one person is selected
    //     if (empty($validatedData['user_id'])) {
    //         return redirect()->back()->withInput()->withErrors(['user_id' => 'Please select at least one person.']);
    //     }

    //     // Get the first selected user ID
    //     $firstUserId = $request->input('user_id')[0];

    //     // Loop through each selected schedule ID
    //     foreach ($selectedIds as $scheduleId) {
    //         // Find the schedule by ID
    //         $schedule = Schedule::find($scheduleId);

    //         // If the schedule exists, update it with the details of the first user
    //         if ($schedule) {
    //             // Update the schedule with the details of the first user and remarks
    //             $schedule->user_id = $firstUserId;
    //             $schedule->remarks = $request->remarks;
    //             $schedule->save();

    //             // Replicate and save the schedule for the remaining users
    //             foreach ($request->input('user_id') as $userId) {
    //                 // Skip saving if the user ID is the same as the first user
    //                 if ($userId != $firstUserId) {
    //                     // Clone the original schedule
    //                     $newSchedule = $schedule->replicate();

    //                     // Update the cloned schedule with the user ID
    //                     $newSchedule->user_id = $userId;

    //                     // Save the cloned schedule
    //                     $newSchedule->save();
    //                 }
    //             }
    //         } else {
    //             return redirect()->back()->with('error', 'Please select a valid schedule.');
    //         }
    //     }

    //     // Redirect back with success message
    //     return redirect()->back()->with('success', 'Schedules updated successfully.');
    // }
    // ScheduleController.php




    // Inside your controller method
    public function updateSchedules(Request $request)
    {
        // Retrieve the updated schedule data
        $updatedData = $request->all();

        // Loop through each updated schedule
        foreach ($updatedData as $scheduleData) {
            $scheduleId = $scheduleData['scheduleId'];

            // Find the corresponding schedule record
            $schedule = Schedule::find($scheduleId);

            if ($schedule) {
                // Check if 'person' key is provided and not empty
                if (isset($scheduleData['person']) && !empty($scheduleData['person'])) {
                    // Retrieve user IDs from the updated data
                    $userIds = $scheduleData['person'];

                    // Update the schedule with the first selected user ID
                    $schedule->user_id = $userIds[0]; // Assign the first selected user ID
                }

                // Check if 'remarks' key is provided
                if (isset($scheduleData['remarks'])) {
                    // Retrieve and update remarks from the updated data
                    $remarks = $scheduleData['remarks'];
                    $schedule->remarks = $remarks; // Assign the remarks
                }

                // Save the schedule
                $schedule->save();

                // Log the schedule update
                Log::info('Schedule updated', ['scheduleId' => $scheduleId]);

                // If 'person' key is provided, replicate and save the schedule for the remaining users
                if (isset($scheduleData['person']) && !empty($scheduleData['person'])) {
                    for ($i = 1; $i < count($scheduleData['person']); $i++) {
                        // Clone the original schedule
                        $newSchedule = $schedule->replicate();

                        // Update the cloned schedule with the user ID and remarks
                        $newSchedule->user_id = $scheduleData['person'][$i];

                        // Save the cloned schedule
                        $newSchedule->save();
                    }
                }
            } else {
                // If the schedule is not found, log the situation
                Log::warning('Schedule not found', ['scheduleId' => $scheduleId]);
            }
        }

        // Return success response
        return response()->json(['success' => true]);
    }



    // public function update(Request $request)
    // {

    //     if (!$request->has('selected_ids')) {
    //         return redirect()->back()->with('error', 'No schedule IDs provided.');
    //     }

    //     $selectedIds = explode(',', $request->selected_ids);

    //     if (empty($selectedIds)) {
    //         return redirect()->back()->with('error', 'No schedule IDs provided.');
    //     }
    //     $selectedIds = explode(',', $request->selected_ids);

    //     // Update the first schedule
    //     $firstSchedule = Schedule::find($selectedIds[0]);
    //     $firstSchedule->user_id = $request->user_id;
    //     $firstSchedule->remarks = $request->remarks;


    //     // Update other fields as needed
    //     $firstSchedule->save();

    //     // Update all other schedules with the same values
    //     foreach ($selectedIds as $id) {
    //         if ($id != $selectedIds[0]) { // Skip the first schedule
    //             $schedule = Schedule::find($id);
    //             $schedule->user_id = $request->user_id;
    //             $schedule->remarks = $request->remarks;

    //             // Update other fields as needed
    //             $schedule->save();
    //         }
    //     }

    //     return redirect()->back()->with('success', 'Schedules updated successfully.');
    // }




}
