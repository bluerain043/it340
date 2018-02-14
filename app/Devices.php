<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{
    protected $table = 'devices';
    protected $primaryKey = "devices";
    protected $fillable = [
       'seat', 'room', 'name', 'sticker', 'brand', 'serial', 'end_of_life'
    ];

    public function _student()
    {
        return $this->hasMany(Students::class, 'students', 'students');
    }
}
