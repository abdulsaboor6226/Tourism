@extends('layouts.master')

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Transfer process</h4>
                <form class="form-sample" action="{{ route('transfer.update',$transfer->id) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <p class="card-description">
                        Personal info
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="vehicle_id">Vehicle</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="vehicle_id" id="vehicle_id">
                                        @foreach ($vehicles as $id => $value)
                                            <option {{ $id == $transfer->vehicle_id ? 'Selected' : '' }}
                                                    value="{{ $id }}">
                                                {{ $value->name }} - {{$value->number}} - {{$value->model}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="driver_id">Driver</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="driver_id" id="driver_id">
                                        @foreach ($drivers as $id => $value)
                                            <option {{ $id == $transfer->driver_id ? 'Selected' : '' }}
                                                    value="{{ $id }}">
                                                {{ $value->name }} - {{$value->phone}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="passenger_id">Passenger</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="passenger_id" id="passenger_id">
                                        @foreach ($passengers as  $value)
                                            <option {{ $id == $transfer->passengers_id ? 'Selected' : '' }}
                                                    value="{{ $value->id }}">
                                                {{ $value->name }} - {{$value->phone}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="status_id">Status ID</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status_id" id="status_id">
                                        @foreach ($status as $id => $value)
                                            <option {{ $id == $transfer->status_id ? 'Selected' : '' }}
                                                    value="{{ $id }}">
                                                {{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="from">From</label>
                                <div class="col-sm-9">
                                    <input type="text" name="from" placeholder="Bahawalpur" class="form-control"
                                           value="{{ old('from',$transfer->from) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="to">To</label>
                                <div class="col-sm-9">
                                    <input type="text" name="to" placeholder="Lahore" class="form-control"
                                           value="{{ old('to',$transfer->to) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Departure</label>
                                <div class="col-sm-9">
                                    <input type="datetime-local" name="departure_dateTime" class="form-control"
                                           value="{{ old('departure_dateTime',$transfer->departure_dateTime) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Reaching</label>
                                <div class="col-sm-9">
                                    <input type="datetime-local" name="reaching_dateTime" class="form-control"
                                           value="{{ old('reaching_dateTime',$transfer->reaching_dateTime) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    @can('user.create')
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    @endcan
                    <a class="btn btn-light" href="{{ route('transfer.index') }}">Cancel</a>
                </form>
            </div>
        </div>
    </div>

@endsection
