<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Psy\Command\WhereamiCommand;
use Illuminate\Http\Request;
use Auth;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        return '/userhome';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    // public function showLoginForm($id)
    // {

    // }
    public function username()
    {
        return 'userID';
    }

    protected function authenticated(Request $request, $user)
    {
        if (!$user->isActive) {
            Auth::logout();
            return redirect('login')->with('success', 'You are not an active User');
        }
        // $user->application_id = $request->input('application_id');
        // $user->save();   
    }


    public function getUserDetails($id)
    {
        //   $user = User::where('userID','=',$id)->first();
        // return response()->json($user);
        $user = DB::table('users')
            ->join('department', 'users.dep_id', '=', 'department.id')
            ->select('users.name', 'users.email', 'users.designation', 'department.name as dep_name', )
            ->where('users.userID', $id)
            ->first();

        return response()->json($user);

    }

}