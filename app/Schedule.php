<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = "schedule";
    protected $primaryKey = "schedule";
    protected $fillable = [
        'day',
        'time',
        'room',
        'teacher',
        'subject',
        'status'
    ];

    public static $days = ['MWF' => 'Monday, Wednesday, , Friday', 'TTH' => 'Tuesday, Thursday', 'Sat' => 'Saturday'];
    public static $time = ['1' => '7:30AM - 8:30 AM', '2' => '8:30AM - 9:30 AM', '3' => '9:30AM - 10:30 AM', '4' => '10:30AM - 11:30 AM', '5' => '12:30AM - 1:30 AM',
            '6' => '1:30PM - 2:30 PM', '6' => '2:30PM - 3:30 PM', '7' => '3:30PM - 4:30 PM', '8' => '5:30PM - 6:30 PM', '9' => '7:30AM - 11:30 AM'];

    public function _room()
    {
        return $this->belongsTo('App\Room', 'room');
    }

    /*public function _students()
    {
        return $this->belongsToMany(Students::class, 'student_schedule', 'student', 'schedule')
            ->withPivot('student')
            ->withTimestamps();
    }*/

}
