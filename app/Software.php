<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $table = 'software';
    protected $fillable = [
        'software',
        'name',
        'purchase_date',
        'students',
        'seat_number',
        'room',
        'end_of_life'
    ];
}
