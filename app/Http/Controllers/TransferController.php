<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\Transfer;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transfers = Transfer::query()->latest();
//        if ($request->name) {
//            $transfers = $transfers->where('name','LIKE','%'.$request->name.'%');
//        }
        $transfers = $transfers->with('status','vehicle','driver','passenger')->paginate(20);
        return view('transfer.index',compact('transfers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = Dictionary::userStatus()->pluck('value','id');
        $drivers = User::role('driver')->whereRelation('status','sort',1)->get();
        $passengers = User::role(['staff','patient'])->whereRelation('status','sort',1)->get();
        $vehicles = Vehicle::latest()->whereRelation('status','sort',1)->get();
        return view('transfer.create',compact('status','drivers','passengers','vehicles'));
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
            'vehicle_id'=>'required|numeric',
            'driver_id'=>'required|numeric',
            'passenger_id'=>'required|numeric',
            'from'=>'required|string',
            'to'=>'required|string',
            'departure_dateTime'=>'required',
            'reaching_dateTime'=>'nullable',
            'status_id'=>'required|numeric',
        ]);

        $createTransfer = Transfer::create($request->except('_token'));
        if(!$createTransfer){
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        }
        else{
            Session::flash('message', 'Transfer Process has been successfully created');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('transfer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer)
    {
        $status = Dictionary::userStatus()->pluck('value','id');
        $drivers = User::role('driver')->whereRelation('status','sort',1)->get();
        $passengers = User::role(['staff','patient'])->whereRelation('status','sort',1)->get();
        $vehicles = Vehicle::latest()->whereRelation('status','sort',1)->get();
        return view('transfer.edit',compact('status','drivers','passengers','vehicles','transfer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transfer $transfer)
    {
        $this->validate($request,[
            'vehicle_id'=>'required|numeric',
            'driver_id'=>'required|numeric',
            'passenger_id'=>'required|numeric',
            'from'=>'required|string',
            'to'=>'required|string',
            'departure_dateTime'=>'required',
            'reaching_dateTime'=>'nullable',
            'status_id'=>'required|numeric',
        ]);

        $createTransfer =  Transfer::whereId($transfer->id)->update($request->except('_token','_method'));
        if(!$createTransfer){
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        }
        else{
            Session::flash('message', 'Transfer Process has been successfully created');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->route('transfer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteTransfer = Transfer::destroy($id);
        if(!$deleteTransfer){
            Session::flash('message', 'OOP! something went wrong');
            Session::flash('alert-class', 'alert-danger');
        }
        else{
            Session::flash('message', 'Transfer has been successfully deleted');
            Session::flash('alert-class', 'alert-success');
        }
        return redirect()->back();
    }
}
