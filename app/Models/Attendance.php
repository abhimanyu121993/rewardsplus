<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $casts=[
        'clock_in'=>'datetime',
        'clock_out'=>'datetime'
    ];
    protected $guarded=[];
}
