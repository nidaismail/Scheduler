<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\Grade;
// namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\Schedule;

class UserdashboardController extends Controller
{
    // public function preview()
    // {
    //     $today = Today()->toDateString();
    //     $user_role = Auth::user()->getRoleNames();
    //     $classes = Grade::all();
    //     return view('userdashboard')->with(compact('classes'));
<<<<<<< HEAD

    // foreach ($user_role as $role) {
    //     if ($role == 'admin') {

    //         $persondata = Schedule::where('date', '>=', $today)
    //                                     ->with(['user','activity','location'])
    //                                     ->orderBy('date')
    //                                     ->get();       
    //                                     $classes = Grade::all();                 
    //             return view('userdashboard')->with(compact('persondata','classes'));

    //     } elseif ($role == 'supervisor') {
    //             $persondata = Schedule::where('department', '=', Auth::user()->dep_id)
    //                                     ->where('date', '>=', $today)
    //                                     ->with(['user','activity','location'])
    //                                     ->orderBy('date')
    //                                     ->get();     
    //                                     $classes = Grade::all();                     
    //             return view('userdashboard')->with(compact('persondata','classes'));
    //     } else {

    //         $persondata = Schedule::where('user_id', '=', Auth::user()->userID)
    //                                 ->where('date', '>=', $today)
    //                                 ->with(['user','activity','location'])
    //                                 ->orderBy('date')
    //                                 ->get();    
    //                                 $classes = Grade::all();                
    //         return view('userdashboard')->with(compact('persondata','classes'));
    //     }
    // }
    // 
    public function preview(Request $request)
    {
        $classes = Grade::all();

        // Check if form data is submitted
        if ($request->filled(['start_date', 'end_date', 'classSelection'])) {
            // Retrieve form inputs
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $classSelection = $request->input('classSelection');

            // Query to fetch schedules based on the selected date range and class
            $filteredData = Schedule::where('date', '>=', $startDate)
                ->where('date', '<=', $endDate)
                ->where('class_id', $classSelection)
                ->orderBy('date', 'asc')
                ->get();

            // Pass fetched schedules to the same view for display
            return view('userdashboard')->with(compact('filteredData', 'classes'));
        }

        // Pass classes data to the view for initial form display
        return view('userdashboard')->with(compact('classes'));
    }

    public function filterData(Request $request)
    {
        // Retrieve form inputs
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $classSelection = $request->input('classSelection');

        // Query to fetch filtered data from the database based on the inputs
        $persondata = Schedule::where('date', '>=', $startDate)
            ->where('date', '<=', $endDate)
            ->where('class', $classSelection)
            ->orderBy('date', 'asc')
            ->get();

        // Assuming 'filteredData' is passed to a view for rendering
        return view('filtered-data-view', ['persondata' => $persondata]);
    }

    // public function classview(){
    //     $today = Today()->toDateString();
    //     $schedules = Schedule::where('date', '>=', $today)
    //                                         ->with(['user','activity','location'])
    //                                         ->orderBy('date')
    //                                         ->get();      
    //                                         $classes = Grade::all();               
    //                 return view('classview')->with(compact('schedules','classes'));
    //     }



    public function admissible(Request $request)
    {
        $data = Schedule::whereIn('id', $request['schedule_id'])->update(['admissible' => 1]);
        $data = Schedule::whereNotIn('id', $request['schedule_id'])->update(['admissible' => 0]);

        // $data->admissible = $request['schedule_id'];
    }


    public function index()
    {
        $users = DB::select('select * from schedule');
        return view('user_delete_view', ['users' => $users]);
    }

    public function deleteRecords(Request $request, $ids)
    {
        $idArray = explode(',', $ids);

=======

    // foreach ($user_role as $role) {
    //     if ($role == 'admin') {

    //         $persondata = Schedule::where('date', '>=', $today)
    //                                     ->with(['user','activity','location'])
    //                                     ->orderBy('date')
    //                                     ->get();       
    //                                     $classes = Grade::all();                 
    //             return view('userdashboard')->with(compact('persondata','classes'));

    //     } elseif ($role == 'supervisor') {
    //             $persondata = Schedule::where('department', '=', Auth::user()->dep_id)
    //                                     ->where('date', '>=', $today)
    //                                     ->with(['user','activity','location'])
    //                                     ->orderBy('date')
    //                                     ->get();     
    //                                     $classes = Grade::all();                     
    //             return view('userdashboard')->with(compact('persondata','classes'));
    //     } else {

    //         $persondata = Schedule::where('user_id', '=', Auth::user()->userID)
    //                                 ->where('date', '>=', $today)
    //                                 ->with(['user','activity','location'])
    //                                 ->orderBy('date')
    //                                 ->get();    
    //                                 $classes = Grade::all();                
    //         return view('userdashboard')->with(compact('persondata','classes'));
    //     }
    // }
    // 
    public function preview(Request $request)
    {
        $classes = Grade::all();

        // Check if form data is submitted
        if ($request->filled(['start_date', 'end_date', 'classSelection'])) {
            // Retrieve form inputs
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $classSelection = $request->input('classSelection');

            // Query to fetch schedules based on the selected date range and class
            $filteredData = Schedule::where('date', '>=', $startDate)
                ->where('date', '<=', $endDate)
                ->where('class_id', $classSelection)
                ->orderBy('date', 'asc')
                ->get();

            // Pass fetched schedules to the same view for display
            return view('admin.userdashboard')->with(compact('filteredData', 'classes'));
        }

        // Pass classes data to the view for initial form display
        return view('admin.userdashboard')->with(compact('classes'));
    }
    // public function removeview(Request $request)
    // {
    //     $classes = Grade::all();

    //     // Check if form data is submitted
    //     if ($request->filled(['start_date', 'end_date', 'classSelection'])) {
    //         // Retrieve form inputs
    //         $startDate = $request->input('start_date');
    //         $endDate = $request->input('end_date');
    //         $classSelection = $request->input('classSelection');

    //         // Query to fetch schedules based on the selected date range and class
    //         $filteredData = Schedule::where('date', '>=', $startDate)
    //             ->where('date', '<=', $endDate)
    //             ->where('class_id', $classSelection)
    //             ->orderBy('date', 'asc')
    //             ->get();

    //         // Pass fetched schedules to the same view for display
    //         return view('admin.remove')->with(compact('filteredData', 'classes'));
    //     }

    //     // Pass classes data to the view for initial form display
    //     return view('admin.remove')->with(compact('classes'));
    // }
    public function filterData(Request $request)
    {
        // Retrieve form inputs
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $classSelection = $request->input('classSelection');

        // Query to fetch filtered data from the database based on the inputs
        $persondata = Schedule::where('date', '>=', $startDate)
            ->where('date', '<=', $endDate)
            ->where('class', $classSelection)
            ->orderBy('date', 'asc')
            ->get();

        // Assuming 'filteredData' is passed to a view for rendering
        return view('filtered-data-view', ['persondata' => $persondata]);
    }

    // public function classview(){
    //     $today = Today()->toDateString();
    //     $schedules = Schedule::where('date', '>=', $today)
    //                                         ->with(['user','activity','location'])
    //                                         ->orderBy('date')
    //                                         ->get();      
    //                                         $classes = Grade::all();               
    //                 return view('classview')->with(compact('schedules','classes'));
    //     }



    public function admissible(Request $request)
    {
        // Validate the request
        $request->validate([
            'schedule_id' => 'required|integer|exists:schedules,id',
            'admissible' => 'required|boolean'
        ]);

        // Find the schedule by ID and update the admissible status
        $schedule = Schedule::findOrFail($request->schedule_id);
        $schedule->admissible = $request->admissible;
        $schedule->save();

        return response()->json(['success' => 'Admissible status updated successfully.']);
    }



    public function index()
    {
        $users = DB::select('select * from schedule');
        return view('user_delete_view', ['users' => $users]);
    }

    public function deleteRecords(Request $request, $ids)
    {
        $idArray = explode(',', $ids);

>>>>>>> e905996f0d85753db0090882a3740de079a99306
        try {
            Schedule::whereIn('id', $idArray)->delete();
            return response()->json(['success' => 'Records deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete records: ' . $e->getMessage()], 500);
        }
    }
}








