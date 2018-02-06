<?php

namespace App\Http\Controllers;

use App\Room;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
}
