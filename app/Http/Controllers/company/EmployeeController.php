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
        'pan_no' => 'required|digits:10',
        'account_no' => 'required|digits:10',
        'ifsc_code' => 'required|alpha_num|size:10',
        'aadhar_no' => 'required|digits:10',
        'contact' => 'required|digits:10',
    ]);    
          $data=Auth::guard(Helper::getGuard())->user()->employees()->updateOrCreate([
            'email'=>$req->email,
            'employeeable_id'=>$req->company_id,
          ],[
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
            'adhar_number'=>$req->aadhar_no,
            'pan_number'=>$req->pan_no,
            'account_number'=>$req->account_no,
          ],[
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
        $data = CompanyDetail::get(['company_name','id']);
        return view('employee.edit',compact('store','data'));
    }
    public function fetchcompany($id)
    {
        $user = Company::with('store')->find($id);
        //dd($user->store);
        $html ='<option selected disabled hidden>Select your Store</option>';
        foreach($user->store as $dt){
            $html.="<option value=".$dt->id.">".$dt->name."</option>";
        }
        return $html;
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
