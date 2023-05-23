<?php

namespace App\Http\Controllers\company;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\Attendance;
use Carbon\Carbon;
use Exception;

class AttendanceController extends Controller
{
    public function index()
    {
      $employees=Auth::guard(Helper::getGuard())->user()->employeeable;
      return view('company.attendance',compact('employees'));
    }

    public function clock_in(Request $req)
    {
        $req->validate(['employee_id'=>'required|array','employee_id.*'=>'exists:employees,id']);
        try{
        foreach($req->employee_id as $eid){
            Attendance::create([
                'employee_id'=>$eid,
                'clock_in'=>Carbon::now()
            ]);
        }
        return redirect()->back()->with('toast_success','Attendance marked successfully');
    }
    catch(Exception $ex){
        return redirect()->back()->with('toast_error','Server Error - '.$ex->getMessage());
    }
    }
}
