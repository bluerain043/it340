<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Room;
use App\Schedule;
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
        $bActive = true;
        return view('room.add_room', compact('allRooms', 'bActive'));
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
        $all_student = $room->_student()->where('room', $room->room)->get();
        $schedules = $room->_schedule()->where('status', '1')->get();
        $allRooms = Room::getAllRooms('room_name');
        return view('room.room_edit', compact('room', 'all_student', 'schedules', 'allRooms'));
    }

    public function ajax_save_new_student(Request $request)
    {
        $validator = \Validator::make($request->except(['_token', 'students', 'ajaxReturn']),[
                'student_name' => 'required',
                'department' => 'required',
                'course' => 'required',
                'year' => 'required',
            ]
        );

        if ($validator->fails() && (isset($request->ajaxReturn) && $request->ajaxReturn == TRUE)) {
            return response()->json(['errors' => $validator->errors()]);
        }else{
            $student = new Students();
            $student = $student->where('students', $request->students);
            $save = $student->update($request->except(['_token', 'student', 'ajaxReturn']));
            return ($save)
                ? response(['status' => 'ok', 'data' => $student])
                : response(['status' => 'failed']);
        }

    }

    public function save_new_student(Request $request)
    {
        $student = new Students();
        if(!isset($request->student_id)){
            $student->create($request->except(['_token']));
        }else{
            $student = $student->where('students', $request->student_id);
            $student->update($request->except(['_token', 'student_id']));
        }


    }
    public function schedule()
    {
        $allRooms = Room::getAllRooms('room_name');
        $schedules = Schedule::query()->where('status', 1)->orderBy('created_at')->get();
        return view('room.schedule', compact('allRooms', 'schedules'));
    }

    public function post_schedule(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required',
            'day' => 'required',
            'room' => 'required',
            'teacher' => 'required',
            'status' => 'required'
        ]);
        $schedule = new Schedule();
        $schedule->create($request->except(['_token']));
        return back()->with('success', 'Schedule added successfully!');
    }

    public function room_view_edit_schedule(Room $room, Schedule $schedule)
    {
        $all_student = $room->_student()->where('room', $room->room)->where('schedule', $schedule->schedule)->get();dd($all_student);
        $schedules = $room->_schedule()->where('status', '1')->get();
        return view('room.room_edit', compact('room', 'all_student', 'schedules'));
    }
}
