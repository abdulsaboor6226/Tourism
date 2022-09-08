@extends('layouts.master')

@section('content')
    @can('transfer.create')
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-end mb-2 mr-3">
                    <a type="button" class="btn btn-primary btn-icon-text" href="{{ route('transfer.create') }}"><i class="ti-plus btn-icon-prepend"></i>Add Transfer
                    </a>
                </div>
            </div>
        </div>
    @endcan
{{--        <div class="col-12 grid-margin stretch-card">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <h4 class="card-title">Filters</h4>--}}
{{--                    <form class="form-inline filter-form" action="{{route('transfer.index')}}" method="GET">--}}
{{--                        <label class="sr-only" for="inlineFormInputName2">Name</label>--}}
{{--                        <input type="text" class="form-control mb-2 mr-sm-2" name="name" value="{{request()->input('name')}}" id="inlineFormInputName2" placeholder="Name">--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Transfer</h4>
                    <p class="card-description">
{{--                        Add class <code>.table-hover</code>--}}
                    </p>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Vehicle</th>
                                <th>Driver</th>
                                <th>Passenger</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Departure</th>
                                <th>Reaching</th>
                                <th>Status</th>
                                <th>Created at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transfers as $transfer)
                                <tr>
                                    <td>{{$transfer->id}}</td>
                                    <td>{{$transfer->vehicle->name}} - <b>{{$transfer->vehicle->number}}</b></td>
                                    <td>{{$transfer->driver->name}} - <b>{{$transfer->driver->phone}}</b></td>
                                    <td>{{$transfer->passenger->name}} - <b>{{$transfer->passenger->phone}}</b> - {{$transfer->passenger->roles[0]->name}}</td>
                                    <td>{{$transfer->from}}</td>
                                    <td>{{$transfer->to}}</td>
                                    <td>{{$transfer->departure_dateTime}}</td>
                                    <td>{{$transfer->reaching_dateTime}}</td>
                                    <td><label class="badge badge-{{$transfer->status->meta['color']}}">{{$transfer->status->value}}</label></td>
                                    <td>{{ $transfer->created_at->diffForHumans() }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="text-primary fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" style="">
                                                @can('transfer.edit')
                                                    <a class="dropdown-item" href="{{ route('transfer.edit', $transfer->id) }}"><i
                                                            class="far fa-edit m-2"> Edit</i>
                                                    </a>
                                                @endcan
                                                {{-- <a class="dropdown-item" href="{{ route('transfer.show', $transfer->id) }}">
                                                    <i class="fa fa-eye m-2" aria-hidden="true"> Show</i>
                                                </a> --}}
                                                @can('transfer.delete')
                                                    <a class="dropdown-item" onclick='swal({
                                                            title: "Are you sure?",
                                                            text: "Your will not be able to recover this imaginary file!",
                                                            type: "warning",
                                                            showCancelButton: true,
                                                            confirmButtonClass: "btn-danger",
                                                            confirmButtonText: "Yes, delete it!",
                                                            closeOnConfirm: false
                                                            },
                                                            function(){
                                                            document.getElementById("delete-job-{{ $transfer->id }}").submit();
                                                            swal("Deleted!", "Your imaginary file has been deleted.", "success");
                                                            });' onclick="event.preventDefault();">
                                                        <i class="fas fa-trash-alt m-2"> Delete</i>
                                                    </a>
                                                @endcan
                                            </div>
                                            <form id="delete-job-{{ $transfer->id }}"
                                                  action="{{ route('transfer.destroy', $transfer->id) }}" method="POST"
                                                  style="display: none;">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$transfers->links()}}
                </div>
            </div>
        </div>
@endsection
