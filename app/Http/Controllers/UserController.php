<?php

namespace App\Http\Controllers;

use App\Room;
use App\Schedule;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = new User();
        $schedule = new Schedule();
        $allRooms = Room::getAllRooms('room_name');//dd($allRooms);
        $users = $user->where('status', 1)->get();
        $schedules = $schedule->where('status', 1)->get();//dd($schedules);


        return view('user.index', compact('allRooms', 'users', 'schedules'));
    }
    public function create_user(){

        $allRooms = Room::getAllRooms('room_name');
        return view('user.create_user', compact('allRooms'));
    }

    public function post_create_user(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => $request->is_admin,
        ]);

        return back()->with('success', 'Room added successfully!');
    }

    public function user_list()
    {
        $users = User::all();
        $allRooms = Room::getAllRooms('room_name');
        return view('user.users_list', compact('allRooms', 'users'));
    }

    public function get_user_data(Request $request)
    {
        $user = User::where('id', $request->user)->first();
        $view = \View::make('modals.edit_user_modal', ['user' => $user]);
        $html = $view->render();
        return \Response::json(['html' => $html, 'data' => $user]);
    }

    public function post_edit_user(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->update($request->except(['_token']));
        return back()->with('success', 'User Updated added successfully!');
    }

    public function delete_user(Request $request)
    {

        $user = User::where('id', $request->user)->first();
        $delete = $user->update(['status' => 0]);
        return ($delete)
            ? response(['status' => 'ok'])
            : response(['status' => 'failed']);
    }

    public function delete_by_id(Request $request)
    {
        $table = $request->table;
        $table_field = ['devices', 'students', 'specifications', 'software'];
        foreach ($table_field as $tf){
            if($table == $tf){
                $bDelete = DB::table($tf)->where($tf, $request->id)->delete();
            }
        }
      /*  return back()->with('success', 'Entry deleted successfully!');*/
        return ($bDelete)
            ? response(['status' => 'ok'])
            : response(['status' => 'failed']);
    }
}
