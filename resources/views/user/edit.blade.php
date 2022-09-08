@extends('layouts.master')

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit User</h4>
                <form class="form-sample" action="{{ route('user.update',$user->id) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <p class="card-description">
                        Personal edit info
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="{{ old('name',$user->name) }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" value="{{ old('email',$user->email) }}" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="phone">Phone</label>
                                <div class="col-sm-9">
                                    <input type="phone" name="phone" placeholder="920123456789" class="form-control" value="{{ old('phone',$user->phone) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="password">Password</label>
                                <div class="col-sm-9">
                                    <input type="text" name="password" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                        @if($user->hasRole('agent'))
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="commission_rate">Commission Rate</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="commission_rate" class="form-control" value="{{ old('commission_rate',$user->meta['commission_rate']) }}">
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="status_id">Status</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="status_id" id="status_id">
                                        @foreach ($status as $id => $value)
                                            <option {{ $id == $user->status_id ? 'Selected' : '' }}
                                                    value="{{ $id }}">
                                                {{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="role">Role</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="role" id="role">
                                        @foreach ($roles as $id => $value)
                                            <option {{ $value == $user->roles[0]->name ? 'Selected' : '' }} value="{{ $value }}">
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Profile Image</label>
                                <div class="col-sm-9">
                                    <input type="file" value="{{ old('profile_image') }}" accept="image/*" data-default-file="{{$user->profile_image}}"  class="dropify form-control"
                                           name="profile_image">
                                </div>
                            </div>
                        </div>
                    </div>
                    @can('user.update')
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    @endcan
                    <a class="btn btn-light" href="{{route('user.index')}}">Cancel</a>
                </form>
            </div>
        </div>
    </div>

@endsection
