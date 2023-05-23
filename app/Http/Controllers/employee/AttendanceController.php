<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\PermissionName;
use App\Helpers\Helper;
class AttendanceController extends Controller
{
    public function index()
    {
        $attendances=Attendance::where('employee_id',Auth::guard(Helper::getGuard())->user()->id)->latest()->paginate(10);
        $today=Attendance::where('employee_id',Auth::guard(Helper::getGuard())->user()->id)->whereDate('clock_in',carbon::now())->exists();
        return view('employee.attendance.index',compact('attendances','today'));
    }

    public function clock_in()
    {
     $data=Attendance::where('employee_id',Auth::guard(Helper::getGuard())->user()->id)->whereDate('clock_in',Carbon::now()->format('Y-m-d'))->first();
     if($data){
        return redirect()->back()->with('toast_warning','You Have Already Clocked In Today');
     }
     else
     {
        Attendance::create([
            'employee_id'=>Auth::guard(Helper::getGuard())->user()->id,
            'clock_in'=>Carbon::now()
        ]);
     }
     return redirect()->back()->with('toast_success','Clocked In Successfully');
    }
    public function clock_out()
    {
       $data=Attendance::where('employee_id',Auth::guard(Helper::getGuard())->user()->id)->whereDate('clock_out',Carbon::now()->format('Y-m-d'))->first();
       if($data){
        return redirect()->back()->with('toast_warning','You Have Already Clocked Out Today');
        }
        else
        {
            Attendance::where(['employee_id'=>Auth::guard(Helper::getGuard())->user()->id])->whereDate('clock_in',Carbon::now())->update([
                'employee_id'=>Auth::guard(Helper::getGuard())->user()->id,
                'clock_out'=>Carbon::now()
                ]);
        }
                return redirect()->back()->with('toast_success','Clocked Out Successfully');
    }
}
