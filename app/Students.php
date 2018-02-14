<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Room;

class Students extends Model
{
    protected $table = "students";
    protected $primaryKey = "students";
    protected $fillable = [
        'seat',
        'student_name',
        'department',
        'course',
        'status',
        'year',
        'pos_x',
        'pos_y',
        'room'
    ];

    public function _room(){
        return $this->hasMany('App\Room', 'room', 'room');
    }

    public function _schedule()
    {
        return $this->belongsToMany(Schedule::class, 'student_schedule', 'student', 'schedule')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function _seat()
    {
       /* return $this->hasMany(Students::class, 'students', 'students');*/
        /*return $this->belongsToMany(Seat::class, 'students', 'room', 'seat_number')
            ->withPivot('students', 'student_name', 'department', 'course', 'year');*/
        return $this->belongsToMany(Seat::class, 'students', 'room', 'seat');
           /* ->withPivot('students', 'student_name', 'department', 'course', 'year');*/

    }

    public function get_all_student_by_room(Room $room, $seat_number = null)
    {

        /*$qry = $this->leftJoin('surveys', 'surveys.id', '=', 'surveys_other_prices.survey_id')
            ->where('surveys.status', '!=', 'removed')->where('surveys.status', '!=', 'purchased')->whereNotNull('contract_number');*/

       return $this->leftJoin('seat', 'students.seat_number', '=', 'seat.seat')
            ->where('students.room', '=', $room->room)
            ->where('seat.seat', '=', $seat_number)
            ->select(['students.students', 'students.seat_number', 'students.student_name', 'students.department', 'students.course', 'students.year', 'seat.*']);
    }

}
