<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $table = 'seat';
    protected $primaryKey = "seat";
    protected $fillable = [
        'seat',
        'room',
        'pos_x',
        'pos_y',
        'status'
    ];

    public function _student()
    {
       return $this->hasMany(Students::class, 'students', 'seat_number');
    }
}
