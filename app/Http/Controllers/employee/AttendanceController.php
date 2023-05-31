<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\PermissionName;
use App\Helpers\Helper;
use App\Imports\AttendanceImport;
use App\Models\Employee;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    public function index(Request $req)
    {
        $attendances=Attendance::where('employee_id',Auth::guard(Helper::getGuard())->user()->id)->latest()->paginate(10);
        $today=Attendance::where('employee_id',Auth::guard(Helper::getGuard())->user()->id)->whereDate('date',carbon::now()->format('Y-m-d'))->first();
        return view('employee.attendance.index',compact('attendances','today'));
    }
    public function clock_in()
    {
     $data=Attendance::where('employee_id',Auth::guard(Helper::getGuard())->user()->id)->whereDate('date',Carbon::now()->format('Y-m-d'))->first();
     if($data){
        return redirect()->back()->with('toast_warning','You Have Already Clocked In Today');
     }
     else
     {
        Attendance::create([
            'employee_id'=>Auth::guard(Helper::getGuard())->user()->id,
            'clock_in'=>Carbon::now()->format('h:i'),
            'date'=>Carbon::now()->format('Y-m-d'),
            'status'=>'present'
        ]);
     }
     return redirect()->back()->with('toast_success','Clocked In Successfully');
    }
    public function clock_out()
    {
       $data=Attendance::where('employee_id',Auth::guard(Helper::getGuard())->user()->id)->whereDate('date',Carbon::now()->format('Y-m-d'))->whereNotNull('clock_out')->first();
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

    // bulk attendance
    
    function bulk_attendance(Request $req)
    {
        $datas=$req->except('_token');
        try{
            foreach($datas as $k=>$d){
                Attendance::updateOrCreate([
                    'employee_id'=>$k,
                    'date'=>Carbon::now()->format('Y-m-d'),
                ],[
                    'employee_id'=>$k,
                    'date'=>Carbon::now()->format('Y-m-d'),
                    'clock_in'=>$d['clock_in'],
                    'clock_out'=>$d['clock_out'],
                    'status'=>$d['status']??'na'
                ]);
            }
            return redirect()->back()->with('toast_success','Attendance marked successfully');
        }
        catch(Exception $ex){
            return redirect()->back()->with('toast_error','Server Error - '.$ex->getMessage());
        }
    }
    public function bulk_attendance_get(Request $req)
    {
        $filter=[];
        $q= Attendance::query();
        if($req->submit=='excel'){
            $q->whereDate('date', '>=',$req->from)->whereDate('date','<=',$req->to);
            if($req->status){
                $q->where('status',$req->status);
            }
           $attendances= $q->whereIn('employee_id',function($query){
                $query->select('id')->from('employees')->where('store_id',Auth::guard(Helper::getGuard())->user()->store_id);
            })->get();

        // dd($data);    
        return Excel::download(new AttendanceImport($attendances),'attendance.xlsx');            
        }
        if(count($req->all())>0){
            $filter['from']=$req->from;
            $filter['to']=$req->to;
            $q->whereDate('date', '>=',$req->from)->whereDate('date','<=',$req->to);
            if($req->status){
                $filter['status']=$req->status;
                $q->where('status',$req->status);
            }
        }
        $attendances=$q->whereIn('employee_id',function($query){
            $query->select('id')->from('employees')->where('store_id',Auth::guard(Helper::getGuard())->user()->store_id);
        })->paginate(10);
        return view('employee.attendance.export',compact('attendances','filter'));
    }
    public function employee_list()
    {
        $employees=Employee::where('store_id',Auth::guard(Helper::getGuard())->user()->store_id)->get();
        $date=Carbon::now()->format('d-m-Y');
        return view('employee.attendance.bulk',compact('employees','date'));
    }

}
