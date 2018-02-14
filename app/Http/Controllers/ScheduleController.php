<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\Room;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get_schedule_details(Request $request)
    {
        $allRooms = Room::getAllRooms('room_name');
        $schedule = Schedule::where('schedule', $request->schedule) ->first();
        $view = \View::make('modals.edit_schedule_modal', ['schedule' => $schedule, 'allRooms' => $allRooms]);
        $html = $view->render();
        return \Response::json(['html' => $html, 'data' => $schedule]);
    }

    public function post_update(Request $request, Schedule $schedule)
    {
        $validator = \Validator::make($request->except(['_token']),[
                'subject' => 'required',
                'teacher' => 'required',
                'room' => 'required',
                'time' => 'required',
                'day' => 'required',
                'status' => 'required'
            ]
        );
        //check wla ni save sa pivot table
        if ($validator->fails() && (isset($request->ajaxReturn) && $request->ajaxReturn == TRUE)) {
            return response()->json(['errors' => $validator->errors()]);
        }else{
            $bUpdate = $schedule->update($request->except(['_token']));
            return ($bUpdate)
                ? response(['status' => 'ok', 'data' => $schedule])
                : response(['status' => 'failed']);
        }

    }

    public function delete_schedule(Request $request)
    {
        $schedule = Schedule::where('schedule', $request->schedule) ->first();
        $delete = $schedule->update(['status' => 0]);
        return ($delete)
            ? response(['status' => 'ok'])
            : response(['status' => 'failed']);
    }

}
