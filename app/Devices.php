<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{
    protected $fillable = [
       'students', 'seat_number', 'room', 'name', 'sticker', 'brand', 'serial', 'end_of_life'
    ];

    public function _student()
    {
        return $this->hasMany(Students::class, 'students', 'students');
    }
}
