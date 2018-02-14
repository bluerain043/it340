<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Room extends Model
{
    protected $table = "room";
    protected $primaryKey = "room";
    protected $fillable = [
        'room_number',
        'room_name',
        'facilitator',
        'cover_image',
        'seatplan_image',
        'status'
    ];

    public function get_all_rooms()
    {
        return $this->where('status', 1)->pluck('room_name');
    }

    public static function getAllRooms($columns = ['*'])
    {
        $rooms = parent::all($columns);
        $all_rooms = [];
        foreach ($rooms as $room){
            $all_rooms = $room->where('status', 1)->get();
        }
        return $all_rooms;
    }

    public function _student()
    {
        return $this->hasMany('App\Students', 'room', 'room');
        //, 'students', 'students'
        //return $this->belongsToMany('App\Students', 'students', 'students');
    }

    public function _schedule()
    {
        //return $this->belongsToMany('App\Schedule', 'room', 'room', 'room');
        return $this->belongsTo('App\Schedule', 'room', 'room');

    }

    public function _specification()
    {
        return $this->hasMany(Specifications::class, 'room', 'room');
    }

    public function _seat()
    {
        return $this->hasMany(Seat::class, 'seat', 'room');
    }
}
