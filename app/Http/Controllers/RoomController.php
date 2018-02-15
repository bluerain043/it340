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
use App\Devices;
use App\Seat;


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
        $validator = \Validator::make($request->except(['_token']),[
                'room_name' => 'required',
                'room_number' => 'required|numeric',
                'facilitator' => 'required'
            ]
        );
        if ($validator->fails()) {
            return back()->with(['errors' => $validator->errors()]);
        }else {
            $room = new Room;
            $seat = $request->file('seatplan_image') ? $request->file('seatplan_image') : '';

            if(!isset($request->room)){
                $seat_name = 'seat_'.time().'.'.$seat->getClientOriginalExtension();
                $room->room_name = $request->room_name;
                $room->room_number = $request->room_number;
                $room->facilitator = $request->facilitator;
                $room->seatplan_image = "/images/".$seat_name;
                $room->status = $request->status;
                $room->save();
                $request->file('seatplan_image')->move(public_path('images'), $seat_name);
            }else{
                //update room
                $room = $room->where('room', $request->room)->first();
                if(!empty($seat)){
                    unlink(public_path($room->seatplan_image));
                    $seat_name = 'seat_'.time().'.'.$seat->getClientOriginalExtension();
                    $room->seatplan_image = "/images/".$seat_name;
                    $request->file('seatplan_image')->move(public_path('images'), $seat_name);
                }
                $room->room_name = $request->room_name;
                $room->room_number = $request->room_number;
                $room->facilitator = $request->facilitator;
                $room->status = $request->status;
                $room->update();
            }

            return back()->with('success', 'Room added successfully!');
        }

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
        $all_student = $schedule->_students()->where('students.status', 1)->where('room', $room->room)->get();
        foreach ($all_student as $student){
            $seat = new Seat();
            /*$seat = $student->_seat()->where('seat.seat', $student->seat)->get();//dd($seat);*/
            $seat = $seat->where('room', $student->room)->where('seat', $student->seat)->first();
            if($seat){
                $student->pos_x = $seat->pos_x;
                $student->pos_y = $seat->pos_y;
                $student->specifications = Specifications::where('room', $student->room)->where('seat', $student->seat)->first();
                $student->software = Software::where('room', $student->room)->where('seat', $student->seat)->get();
                $student->device = Devices::where('room', $student->room)->where('seat', $student->seat)->get();
            }
        }
        $schedules_list = $room->_schedule()->where('status', '1')->get();
        $current_schedule = $schedule->schedule;
        return view('room.room_edit', compact('room', 'all_student', 'schedules_list' , 'schedule', 'current_schedule'));
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
        //check wla ni save sa pivot table
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
            $new_specs = new Specifications();
            $specs = $new_specs->where('specifications', $request->specifications)->first();
            $request['end_of_life'] = Carbon::parse($request->end_of_life);
            $save = $specs ?  $specs->update($request->except(['_token', 'students', 'ajaxReturn'])) : $new_specs->create($request->except(['_token', 'ajaxReturn', 'students']));
            return ($save)
                ? response(['status' => 'ok'])
                : response(['status' => 'failed']);
        }
    }

    public function ajax_save_software(Request $request)
    {
        if(isset($request->individual)){
            $softwares = Software::where('software', $request->software)
                ->update(['name' => $request->name, 'purchase_date' => Carbon::parse($request->purchase_date), 'end_of_life' => Carbon::parse($request->end_of_life)]);
        }else{
            Software::where('room', $request->room)->where('seat', $request->seat)->delete();
            foreach ($request->software as $s){
                $new_software = new Software();
                $new_software->seat = $request->seat;
                $new_software->room = $request->room;
                $new_software->name = $s['name'];
                $new_software->purchase_date = Carbon::parse($s['purchase_date']);
                $new_software->end_of_life = Carbon::parse($s['end_of_life']);
                $new_software->save();
            }
            $softwares = Software::where('room', $request->room)->where('seat', $request->seat)->get();
        }


        return (count($softwares) > 0)
            ? response(['status' => 'ok', 'seat_number' => $request->seat])
            : response(['status' => 'failed']);

    }

    public function ajax_save_device(Request $request)
    {
        if(isset($request->individual)){
            $devices = Devices::where('devices', $request->devices)
                ->update(['name' => $request->name, 'brand' => $request->brand, 'sticker' => $request->sticker, 'serial' => $request->serial, 'end_of_life' => Carbon::parse($request->end_of_life)]);
        }else {
            Devices::where('room', $request->room)->where('seat', $request->seat)->delete();
            foreach ($request->device as $s) {
                $new_device = new Devices();
                $new_device->seat = $request->seat;
                $new_device->room = $request->room;
                $new_device->name = $s['name'];
                $new_device->sticker = $s['sticker'];
                $new_device->brand = $s['brand'];
                $new_device->serial = $s['serial'];
                $new_device->end_of_life = Carbon::parse($s['end_of_life']);
                $new_device->save();
            }
            $devices = Devices::where('room', $request->room)->where('seat', $request->seat)->get();
        }
        return ($devices)
            ? response(['status' => 'ok', 'seat_number' => $request->seat])
            : response(['status' => 'failed']);

    }

    public function save_new_student(Request $request)
    {
        $student = new Students();
        $schedule = new Schedule();
        $seat = new Seat();
        $schedule = $schedule->where('schedule', $request->schedule)->first();
        if(!isset($request->student)){
            $seat = $seat->create($request->except(['_token', 'schedule','pos_x', 'pos_y']));
            $request['seat'] = $seat->seat;
            $student = $student->create($request->except(['_token', 'pos_x', 'pos_y']));
            $student->_schedule()->attach($schedule->schedule, ['status' => 'Active', 'schedule' => $request->schedule, 'student' => $student->students]);
            return response(['status' => 'ok', 'data' => $student, 'schedule' => $schedule]);
        }else{
            $seat = $seat->where('room', $request->room)->where('seat', $request->seat)->first();
            $seat->update($request->except(['_token', 'student', 'seat']));
            $student = $student->where('students', $request->student_id);
            $student = $student->update($request->except(['_token', 'student', 'pos_x', 'pos_y']));
            return response(['status' => 'ok', 'data' => $student, 'schedule' => $schedule , 'seat' => $seat->number]);
        }

    }
    public function schedule()
    {
        $allRooms = Room::getAllRooms('room_name');
        $schedules = Schedule::query()->orderBy('created_at')->get();
        return view('room.schedule', compact('allRooms', 'schedules'));
    }

    public function get_schedule()
    {
        $allRooms = Room::getAllRooms('room_name');
        return view('schedule.add_schedule', compact('allRooms'));
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

    public function save(Request $request)
    {
        $student = new Students();
        if(!isset($request->student_id)){
            $student = $student->create($request->except(['_token']));
            $schedule = new Schedule();
            $schedule = $schedule->where('schedule', $request->schedule)->first();
            $student->_schedule()->attach($schedule->schedule, ['status' => 'Active', 'schedule' => $request->schedule, 'student' => $student->students]);
        }else{
            $student = $student->where('students', $request->student_id);
            $student->update($request->except(['_token', 'student_id']));
        }

        //DISPLAY DATA
        $student = $student->first();
        $all_specs = Specifications::where('students', $student->students)->where('seat_number', $student->seat_number)->first();
        $all_software = Software::where('students', $student->students)->where('seat_number', $student->seat_number)->get();
        $student->specifications = $all_specs;
        $student->software = $all_software;



        $view = \View::make('modals.view_student_modal', ['student' => $student]);
        $html = $view->render();
        return \Response::json(['html' => $html, 'data' => $student]);

    }

    public function get_info_details(Request $request)
    {
        $student = new Students();
        $student = $student->where('students', $request->students)->where('room', $request->room)->first();
        if($student){
            $all_specs = Specifications::where('room', $student->students)->where('seat', $student->seat)->first();
            $all_software = Software::where('room', $student->students)->where('seat', $student->seat)->get();
            $all_device = Devices::where('room', $student->students)->where('seat', $student->seat)->get();
            $student->specifications = $all_specs;
            $student->software = $all_software;
            $student->device = $all_device;
        }
        $current_seat = $request->seat;

        $view = \View::make('modals.view_student_modal', ['current_seat' => $current_seat, 'student' => $student, 'room' => ($request->room) ? $request->room : '']);
        $html = $view->render();
        return \Response::json(['html' => $html, 'data' => $student]);
    }

    public function get_individual_details(Request $request)
    {
        $student = new Students();
        $tab = $request->tab;
        $current_seat = $request->seat;
        if($tab == 'student'){
            $student = $student->where('students', $request->students)->first();
            $view = \View::make('modals.edit_inventory_modal', ['current_seat' => $current_seat, 'student' => $student, 'room' => ($request->room) ? $request->room : '', 'tab' => $tab]);
        }elseif ($tab == 'specification'){
            $specs = Specifications::where('specifications', $request->specifications)->first();
            $view = \View::make('modals.edit_inventory_modal', ['current_seat' => $current_seat, 'specs' => $specs, 'tab' => $tab]);
        }elseif ($tab == 'software'){
            $software = Software::where('software', $request->software)->first();
            $view = \View::make('modals.edit_inventory_modal', ['current_seat' => $current_seat, 'software' => $software, 'tab' => $tab]);
        }elseif ($tab == 'hardware'){
            $device = Devices::where('devices', $request->device)->first();
            $view = \View::make('modals.edit_inventory_modal', ['current_seat' => $current_seat, 'device' => $device, 'tab' => $tab]);
        }


        /*if($student){
            $all_specs = ($tab == 'specification') ? Specifications::where('specifications', $request->specifications)->first() : '';
            $all_software = Software::where('room', $student->students)->where('seat', $student->seat)->get();
            $all_device = Devices::where('room', $student->students)->where('seat', $student->seat)->get();
            $student->specifications = $all_specs;
            $student->software = $all_software;
            $student->device = $all_device;
        }dd($all_specs);*/


        $html = $view->render();
        return \Response::json(['html' => $html, 'data' => $student]);
    }

    public function list_of_room()
    {
         /*$allRooms = Room::getAllRooms('room_name');*/
         $allRooms = Room::all();
         return view('room.list', compact('allRooms', 'schedules'));
    }

    public function save_specification(Request $request)
    {
        $validator = \Validator::make($request->except(['_token', 'ajaxReturn']),[
                'unit_type' => 'required'
            ]
        );
        if ($validator->fails() && (isset($request->ajaxReturn) && $request->ajaxReturn == TRUE)) {
            return response()->json(['errors' => $validator->errors()]);
        }else{
            $new_specs = new Specifications();
            $request['end_of_life'] = Carbon::parse($request->end_of_life);
            $save = $new_specs->create($request->except(['_token']));
            return ($save)
                ? response(['status' => 'ok'])
                : response(['status' => 'failed']);
        }
    }

    public function get_room_details(Request $request)
    {
        $room = Room::where('room', $request->room)->first();
        $view = \View::make('modals.edit_room_modal', ['room' => $room]);
        $html = $view->render();
        return \Response::json(['html' => $html, 'data' => $room]);
    }

    public function post_delete_room(Request $request)
    {
        $delete = Room::where('room', $request->room) ->delete();
        if($delete){
            Seat::where('room', $request->room)->delete();
            Devices::where('room', $request->room)->delete();
            Schedule::where('room', $request->room)->delete();
            Software::where('room', $request->room)->delete();
            Specifications::where('room', $request->room)->delete();
            Students::where('room', $request->room)->delete();
        }
        return ($delete)
            ? response(['status' => 'ok'])
            : response(['status' => 'failed']);
    }
}
