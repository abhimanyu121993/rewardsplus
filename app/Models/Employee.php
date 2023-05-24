<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded=[];

    public function company()
    {
       return $this->belongsTo(Company::class,'company_id');
    }
    public function store()
    {
       return $this->belongsTo(Store::class,'store_id');
    }
    public function employeeable()
    {
        return $this->morphTo();;
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class,'employee_id','id');
    }
    public function getTodayClockInAttribute()
    {
        return self::attendances()->whereDate('clock_in',Carbon::now())->first();
    }
    public function getTodayClockOutAttribute()
    {
        return self::attendances()->whereDate('clock_out',Carbon::now())->first();
    }

    public function leaves()
    {
       return $this->morphMany(Leave::class,'leaveable');
    }
}
