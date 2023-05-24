<?php

namespace App\Http\Controllers\company;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyDetail;
use App\Models\Employee;
use App\Models\EmployeeDetail;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|unique:employees,email|email',
            'contact'=>'required|unique:employees,mobile',
            'password'=>'required|min:8',
            'store_id'=>'required',
            'emp_type'=>'required',
            'emp_code'=>'required',
            'aadhar_no'=>'required',
            'pan_no'=>'required',
            'account_no'=>'required',
            'ifsc_code'=>'required',
            'photo'=>'required',
            'address_proof'=>'required',
            'aadhar'=>'required',
            'pancard'=>'required',
            'address'=>'required',
          ]);
          $data=Auth::guard(Helper::getGuard())->user()->employees()->updateOrCreate([
            'name'=>$req->name,
            'email'=>$req->email,
            'mobile'=>$req->contact,
            'password'=>Hash::make($req->password??12346578),
            'company_id'=>$req->company_id,
            'store_id'=>$req->store_id,
            'employeeable_type'=>get_class(new Company()),
            'employeeable_id'=>$req->company_id,
            'uniqid'=>Str::orderedUuid(),
          ]);
          $d=EmployeeDetail::updateOrCreate([
            'emp_id'=>$data->id,
            'emp_type'=>$req->emp_type,
            'emp_code'=>$req->emp_code,
            'adhar_number'=>$req->aadhar_no,
            'pan_number'=>$req->pan_no,
            'account_number'=>$req->account_no,
            'ifsc_code'=>$req->ifsc_code,
            'photo'=>$req->hasFile('photo')?Helper::Image('Employee/photo',$req->photo,'photo'):'',
            'adhar_img'=>$req->hasFile('aadhar')?Helper::Image('Employee/aadhar',$req->aadhar,'aadhar'):'',
            'address_proof'=>$req->hasFile('address_proof')?Helper::Image('Employee/address_proof',$req->address_proof,'address_proof'):'',
            'pancard_img'=>$req->hasFile('pancard')?Helper::Image('Employee/pancard',$req->pancard,'pancard'):'',
            'other_img'=>$req->hasFile('other')?Helper::Image('Employee/other',$req->other,'other'):'',
            'address'=>$req->address,
          ]);
          if($d and $data)
          {
            return redirect()->back()->with('toast_success','Employee Register Successfully');
          }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $store=Employee::find($id);
        $data=Company::all();
        return view('employee.edit',compact('store','data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Employee::find($id)->delete();
        return redirect()->back()->with('toast_success','Empployee Deleted Successfully');
    }
}
