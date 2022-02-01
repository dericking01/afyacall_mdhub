@extends('layouts.app')


@section('title')
   Email logs
@endsection

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/plugins/datatables/datatable.min.css')}}">
@endsection


@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header card-header-icon">
            <i class="fa fa fa-lock fa-2x"></i>
        </div>
        <div class="card-content">
            <h4 class="card-title">Email logs</h4>
        </div>
        <table class="table table-striped" id="datatable">
            <thead>
                <tr>
                 
                    <th>Time</th>
                    <th>To</th>
                    <th>Message</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logsms as $key => $log)
                    <tr data-entry-id="{{ $log->id }}">
                        <td>{{$log->created_at }}</td>
                        <td>{{ $log->to }}</td>
                        <td>{{ $log->message }}</td>
                        <td class="text-success">{{ $log->status }}</td>
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
              
            });
           
        });
    </script>
@endsection

