<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Room;
use App\Schedule;
use App\Students;
use App\Specifications;
use App\Software;
use App\Devices;
use App\Queries\StudentListQuery;
use App\Queries\DeviceListQuery;
use App\Queries\SoftwareListQuery;
use App\Queries\SpecificationListQuery;

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view_list(Request $request)
    {
        $allRooms = Room::getAllRooms('room_name');
        $room = new Room();
        if(isset($request->room)){
            //if room is in parameter
            $rooms = $room->where('room', $request->room)->where('status', 'Active')->get();
            $current_room = $request->room;
        }else{
            $rooms = $room->where('status', 'Active')->get();
            $current_room = 0;
        }

        if(count($rooms) > 0){
            foreach ($rooms as $room){
                $room->students = $students = Students::where('room', $room->room)->get();
                $room->specs = $specs = Specifications::where('room', $room->room)->get();
                $room->softwares = $softwares = Software::where('room', $room->room)->get();
                $room->devices =  $devices = Devices::where('room', $room->room)->get();
            }
        }
        return view('inventory/inventory_list', compact('rooms', 'allRooms', 'current_room'));

    }

    public function view_list_bk(Request $request)
    {
        $room = new Room();
        $allRooms = Room::getAllRooms('room_name');
        if(isset($request->room)){
            $rooms = $room->where('room', $request->room)->where('status', 'Active')->get();
            $students = new Students();
            $specs = new Specifications();
            $softwares = new Software();
            $devices = new Devices();
        }else{
            //get all data on active rooms
            $rooms = $room->where('status', 'Active')->get();
        }
        if(count($rooms) > 0){
            foreach ($rooms as $room){
                $room->students = $students = Students::where('room', $room->room)->get();
                $room->specs = $specs = Specifications::where('room', $room->room)->get();
                $room->softwares = $softwares = Software::where('room', $room->room)->get();
                $room->devices =  $devices = Devices::where('room', $room->room)->get();
            }
        }
       /* $room->specs = $specs;
        $room->softwares = $softwares;
        $room->devices = $devices;
        $room->students = $students;dd($rooms);*/
        ///return view('room.schedule', compact('allRooms', 'schedules'));
        return view('inventory/inventory_list', compact('rooms', 'allRooms'));
    }

    public function room()
    {
        return Room::all()->pluck('room_name');
    }

    public function search_student(Request $request)
    {

        $room = new Room();
        $allRooms = Room::getAllRooms('room_name');
        $current_room = $request->room;
        if(isset($request->room)){
            $room->room = $room->where('room', $request->room)->where('status', 'Active')->get();
            /*$room->students = (new StudentListQuery($request))->get();*/
            $room->students = ($request->table == 'Students') ?  (new StudentListQuery($request))->get() : Students::where('room', $current_room)->get();//dd('gale');
            $room->specs = ($request->table == 'specification') ? (new SpecificationListQuery($request))->get() : Specifications::where('room', $current_room)->get();
            $room->softwares = ($request->table == 'software') ? (new SoftwareListQuery($request))->get() : Software::where('room', $current_room)->get();
            $room->devices =  ($request->table == 'devices') ? (new DeviceListQuery($request))->get() : Devices::where('room', $current_room)->get();
        }
        $rooms = $room;
        $current_tab = (isset($request->table)) ? $request->table : '';
        return view('inventory/inventory_list_search', compact('rooms', 'allRooms', 'current_room', 'current_tab'));
    }

    public function get_student(Room $room)
    {
        $allRooms = Room::getAllRooms('room_name');
        $student = new Students();
        if(isset($request->room)){
            $students = $student->where('room', $room->room)->get();
        }

        return view('inventory/student', compact('students', 'allRooms', 'room'));

    }

    public function get_specification(Room $room)
    {
        echo 'specs';
    }

    public function get_software(Room $room)
    {
        echo 'software';
    }

    public function get_harware(Room $room)
    {
        echo 'hardware';
    }
}
