@extends('layouts.app')


@section('title')
    My Calls
@endsection

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/plugins/datatables/datatable.min.css')}}">
@endsection


@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header card-header-icon">
            <i class="fa fa fa-phone fa-2x"></i>
        </div>
        <div class="card-content">
            <h4 class="card-title">My Calls</h4>
        </div>
        <table class="table table-striped" id="datatable">
            <thead>
                <tr>
                    <th>Date / Time</th>
                    <th>Caller ID</th>
                    <th>To</th>
                    <th>Doctor Name</th>
                    <th>Duration</th>
                    <th>Talk Time</th>
                    <th>Remained Time</th>
                    <th>Disconnect</th>
                </tr>
            </thead>
            <tbody>
                @foreach($calls as $key => $call)
                <tr data-entry-id="{{ $call->id }}">
                <td>
                    {{ $call->call_date ?? '' }}
                </td>
                <td>
                    {{ $call->caller_number ?? '' }}
                </td>
                <td>
                    {{ $call->doctor['phone'] ?? '' }}
                </td>
                <td>
                   Dr.  {{ $call->doctor['firstname'] ?? '' }} {{ $call->doctor['lastname'] ?? '' }}
                </td>
                <td>
                    {{ $call->call_duration ?? '' }}
                </td>
                <td>
                    {{ $call->call_talktime ?? '' }}
                </td>
                <td>
                    {{ $call->channel ?? '' }}
                </td>
                <td>
                    {{ $call->call_disconnection ?? '' }}
                </td>
            </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('extra-js')
    <script src="{{asset('dashboard/plugins/datatables/datatable.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable({
                order: [[ 0, "desc" ]],
             });
        
        });
    </script>
@endsection

