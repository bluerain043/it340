<?php

namespace App\Http\Controllers;

use App\Student;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Room;
use App\Students;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add_room()
    {
        $allRooms = Room::getAllRooms('room_name');
        return view('room.add_room', compact('allRooms'));
    }

    public function post_add_room(Request $request)
    {
        $this->validate($request, [
           'room_name' => 'required',
           'room_number' => 'required|numeric',
           'facilitator' => 'required',
           'seatplan_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8000',
           'status' => 'required'
        ]);
        $seat = $request->file('seatplan_image');
        $seat_name = 'seat_'.time().'.'.$seat->getClientOriginalExtension();

        $room = new Room;
        $room->room_name = $request->room_name;
        $room->room_number = $request->room_number;
        $room->facilitator = $request->facilitator;
        $room->seatplan_image = "/images/".$seat_name;
        $room->status = isset($request->status) ? 'Active' : 'Inactive';
        $room->save();
        $request->file('seatplan_image')->move(public_path('images'), $seat_name);
        return back()->with('success', 'Room added successfully!');
    }

    public function room_view_edit(Room $room)
    {
        $all_student = Students::query()->where('room', $room->room)->get();
        //$all_student = $room->_student()->where('room', $room->room)->get();
        return view('room.room_edit', compact('room', 'all_student'));
    }

    public function save_new_student(Request $request)
    {
        $student = new Students();
        if($request->student_id == 'new'){
            $student->create($request->except(['_token']));
        }else{
            $student = $student->where('students', $request->student_id);
            $student->update($request->except(['_token', 'student_id']));
        }

    }
}
