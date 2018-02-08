<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specifications extends Model
{
    protected $table = "specifications";
    protected $primaryKey = "specifications";
    protected $fillable = [
        'students',
        'seat_number',
        'room',
        'unit_type',
        'processor',
        'memory',
        'board',
        'hdd',
        'graphics_card',
        'end_of_life',
        'others',
        'in_used'
    ];

    public static $unitType = ['System Unit' => 'System Unit', 'iMac' => 'iMac', 'MacBook' => 'MacBook', 'Laptop' => 'Laptop'];

}
