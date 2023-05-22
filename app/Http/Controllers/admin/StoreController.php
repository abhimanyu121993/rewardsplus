<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use App\Models\Company;
use App\Models\StoreDetail;
use Session;
class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores=Store::latest()->paginate(10);
        return view('store.list',compact('stores'));
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
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }
    public function fetch_old_stores()
    {
        $olddatas=DB::connection('oldmysql')->table('store')->get();
        $failcompany=[];
        foreach($olddatas as $dt){
            $oldCompany=DB::connection('oldmysql')->table('company')->find($dt->company_id);
            $newCompany=Company::where('email',$oldCompany->email)->first();
            if($newCompany){
                $res=Auth::guard(Helper::getGuard())->user()->stores()->updateOrCreate(
                    [
                        'email'=>$dt->email??$newCompany->email,
                    ],[
                    'company_id'=>$newCompany->id,
                    'name'=>$dt->store_name??'',
                    'email'=>$dt->email??$oldCompany->email,
                    'password'=>Hash::make($dt->password??'12345678'),
                    'mobile'=>$dt->contact??'',
                    'ownerable_type'=>get_class(new Company())??'',
                    'ownerable_id'=>$newCompany->id??''
                ]);
                if($res){
                    $d=StoreDetail::updateOrCreate([
                        'store_id'=>$res->id
                    ],[
                        'store_id'=>$res->id,
                        'store_url'=>$dt->store_url??'',
                        'country_id'=>$dt->country_id??'',
                        'state_id'=>$dt->state_id??'',
                        'city_name'=>$dt->city_id??'',
                        'gst_no'=>$dt->gst_no??'',
                        'manager_name'=>$dt->manager??'',
                        // 'pincode'=>$dt->pincode??'',
                        'lat'=>is_float($dt->lat)?$dt->lat:0,
                        'lon'=>is_float($dt->lon)?$dt->lat:0,
                        'code'=>$dt->code??'',
                        'gst_no_code'=>$dt->gst_no_code,
                        'business_state_id'=>$dt->business_state_id,
                        'state_code'=>$dt->state_code,
                        'code'=>$dt->code,
                        'address'=>$dt->address??'',
                    ]);
                }
            }
            else{
                $failcompany[]=$oldCompany->email;
            }
        }
        Session::flash('warning','These companies are not found'.json_encode($failcompany));
        return redirect()->back()->with('toast_success','Fetch all Stores');
    }
}
