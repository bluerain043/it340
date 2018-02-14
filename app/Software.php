<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $table = 'software';
    protected $primaryKey = "software";
    protected $fillable = [
        'software',
        'name',
        'purchase_date',
        'students',
        'seat',
        'room',
        'end_of_life'
    ];
}
