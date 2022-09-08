@extends('layouts.master')

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Vehicle</h4>
                <form class="form-sample" action="{{ route('vehicle.update',$vehicle->id) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <p class="card-description">
                        Personal info
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" placeholder="Civic" value="{{ old('name',$vehicle->name) }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Model Year</label>
                                <div class="col-sm-9">
                                    <input type="number" min="1900" max="2099" step="1" name="model" value="{{ old('model',$vehicle->model) }}"  placeholder="2010" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="phone">Company</label>
                                <div class="col-sm-9">
                                    <input type="text" name="company" placeholder="Honda,Toyota,.." class="form-control" value="{{ old('company' ,$vehicle->company) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="password">Chassis no</label>
                                <div class="col-sm-9">
                                    <input type="text" name="chassis_no" placeholder="cr-1234" class="form-control"
                                           value="{{ old('chassis_no',$vehicle->chassis_no) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="role">Number</label>
                                <div class="col-sm-9">
                                    <input type="text" name="number" placeholder="BRP-12-1234" class="form-control"
                                           value="{{ old('number',$vehicle->number) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="status_id">Color</label>
                                <div class="col-sm-9">
                                    <input type="text" name="color" placeholder="Red" class="form-control"
                                           value="{{ old('color',$vehicle->color) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="status_id">Status ID</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status_id" id="status_id">
                                        @foreach ($status as $id => $value)
                                            <option {{ $id == $vehicle->status_id ? 'Selected' : '' }}
                                                    value="{{ $id }}">
                                                {{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Profile Image</label>
                                <div class="col-sm-9">
                                    <input type="file" class="dropify form-control" accept="image/*" name="image">
                                </div>
                            </div>
                        </div>
                    </div>
                    @can('user.create')
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    @endcan
                    <a class="btn btn-light" href="{{ route('vehicle.index') }}">Cancel</a>
                </form>
            </div>
        </div>
    </div>

@endsection
