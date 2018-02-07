<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Room;
use App\Schedule;
use App\Students;
use App\Specifications;
use App\Software;


class RoomController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add_room()
    {
       /* $loginUser = Auth::user();dd($loginUser);
        if(!empty($loginUser)){
            dd($loginUser);
        }
        dd('gale');*/
        /*if(!empty($loginUser->roles[0]) && $current_user['roles'] == 'administrator') {

        }*/
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
        $schedules_list = $room->_schedule()->where('status', '1')->get();
        $allRooms = Room::getAllRooms('room_name');
        return view('room.room_view', compact('room', 'all_student', 'allRooms', 'schedules_list'));
    }

    public function room_view_edit_schedule(Room $room, Schedule $schedule)
    {
        $all_student = $schedule->_students()->where('status', 'Active')->get();
        foreach ($all_student as $student){
            $all_specs = Specifications::where('students', $student->students)->where('seat_number', $student->seat_number)->first();
            $all_software = Software::where('students', $student->students)->where('seat_number', $student->seat_number)->get();
            $student->specifications = $all_specs;
            $student->software = $all_software;
        }
        $schedules_list = $room->_schedule()->where('status', '1')->get();

        return view('room.room_edit', compact('room', 'all_student', 'schedules_list' , 'schedule'));
    }

    public function ajax_save_new_student(Request $request)
    {
        $validator = \Validator::make($request->except(['_token', 'students', 'ajaxReturn']),[
                'student_name' => 'required',
                'department' => 'required',
                'course' => 'required',
                'year' => 'required|numeric',
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

    public function ajax_save_specification(Request $request)
    {
        $validator = \Validator::make($request->except(['_token', 'ajaxReturn']),[
                'unit_type' => 'required'
            ]
        );
        if ($validator->fails() && (isset($request->ajaxReturn) && $request->ajaxReturn == TRUE)) {
            return response()->json(['errors' => $validator->errors()]);
        }else{
            $specs = new Specifications();
            $specs = $specs->where('students', $request->students);
            $request['end_of_life'] = Carbon::parse($request->end_of_life);
            $save = $specs ?  $specs->update($request->except(['_token', 'student', 'ajaxReturn'])) : $specs->create($request->except(['_token']));
            return ($save)
                ? response(['status' => 'ok'])
                : response(['status' => 'failed']);
        }
    }

    public function ajax_save_software(Request $request)
    {
        /*$software = Software::where('students', $request->students)->where('seat_number', $request->seat_number)->delete();*/
        Software::where('students', $request->students)->where('seat_number', $request->seat_number)->delete();
        $new_software = new Software();
        foreach ($request->software as $s){
            $new_software->students = $request->students;
            $new_software->seat_number = $request->seat_number;
            $new_software->name = $s['name'];
            $new_software->purchase_date = Carbon::parse($s['purchase_date']);
            $new_software->end_of_life = Carbon::parse($s['end_of_life']);
            $save = $new_software->save();
        }
        return ($save)
            ? response(['status' => 'ok'])
            : response(['status' => 'failed']);

    }

    public function save_new_student(Request $request)
    {
        $student = new Students();
        $request->seat_number = $this->generateRandomSeatNumber(4); //gale
        if(!isset($request->student_id)){
            $student = $student->create($request->except(['_token']));
            $schedule = new Schedule();
            $schedule = $schedule->where('schedule', $request->schedule)->first();
            $student->_schedule()->attach($schedule->schedule, ['status' => 'Active', 'schedule' => $request->schedule, 'student' => $student->students]);

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



    private function generateRandomSeatNumber($length=16)
    {
        $characters = '0123456789AB';
        /*$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';*/
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
