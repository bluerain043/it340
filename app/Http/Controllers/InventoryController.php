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

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view_list(Request $request)
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
                $students = Students::where('room', $room->room)->get();
                $specs = Specifications::where('room', $room->room)->get();
                $softwares = Software::where('room', $room->room)->get();
                $devices = Devices::where('room', $room->room)->get();
            }
        }

        $room->specs = $specs;
        $room->softwares = $softwares;
        $room->devices = $devices;
        $room->students = $students;
        ///return view('room.schedule', compact('allRooms', 'schedules'));
        return view('inventory/inventory_list', compact('rooms', 'allRooms'));
    }

    public function room()
    {
        return Room::all()->pluck('room_name');
    }
}
