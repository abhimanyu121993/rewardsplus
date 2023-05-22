<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function company()
    {
       return $this->belongsTo(Company::class,'company_id');
    }
    public function store()
    {
       return $this->belongsTo(Store::class,'store_id');
    }
}