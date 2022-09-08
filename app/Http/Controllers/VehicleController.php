<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vehicles = Vehicle::query();
        if ($request->name) {
            $vehicles = $vehicles->where('name','LIKE','%'.$request->name.'%');
        }
        $vehicles = $vehicles->with('status')->paginate(20);
        return view('vehicle.index',compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = Dictionary::userStatus()->pluck('value','id');
        return view('vehicle.create',compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'model'=>'required',
            'company' => 'required',
            'number' => 'required',
            'color' => 'required',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status_id'=>'required',
        ]);
        if($request->hasFile('image')){
            $request['image_url']=  $request->image->store('public/image');
        }
        $createVehicle = Vehicle::create($request->all());
        if(!$createVehicle){
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        }
        else{
            Session::flash('message', 'Vehicle has been successfully created');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('vehicle.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        $status = Dictionary::userStatus()->pluck('value','id');
        return view('vehicle.edit',compact('vehicle','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $this->validate($request,[
            'name'=>'required',
            'model'=>'required',
            'company' => 'required',
            'number' => 'required',
            'color' => 'required',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status_id'=>'required',
        ]);
        if($request->hasFile('image')){
            $request['image_url']=  $request->image->store('public/image');
        }
        $updateVehicle = Vehicle::whereId($vehicle->id)->update($request->except('_token','_method','image'));
        if(!$updateVehicle){
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        } else{
            Session::flash('message', 'Vehicle info has been successfully Updated');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('vehicle.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteVehicle = Vehicle::destroy($id);
        if(!$deleteVehicle){
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        }
        else{
            Session::flash('message', 'Vehicle has been successfully deleted');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->back();
    }
}
