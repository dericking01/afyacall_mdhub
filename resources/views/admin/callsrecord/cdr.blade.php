@extends('layouts.app')


@section('title')
    CDR
@endsection

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/plugins/datatables/datatable.min.css') }}">
@endsection


@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header card-header-icon">
                <i class="fa fa-users fa-2x"></i>
            </div>
            <div class="card-content">
                <h4 class="card-title">CDR REPORTS</h4>
            </div>
            <table id="datatable" class="table pmd-table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Date / Time</th>
                        <th>Msisdn</th>
                        <th>Reached Stage</th>
                        <th>Call OutCome</th>
                        <th>Service</th>
                        <th>Duration</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($calls as $key => $call)
                    <tr data-entry-id="{{ $call->id }}">
                    <td>
                        {{ $call->created_at ?? '' }}
                    </td>
                    <td>
                        {{ $call->mssidn ?? '' }}
                    </td>
                    
                    <td>
                        {{ $call->callingStage ?? '' }}
                    </td>
    
                    <td>
                        {{ $call->callOutCome ?? '' }}
                    </td>
    
                    <td>
                        {{ $call->service ?? '' }}
                    </td>
                    <td>
                        {{ $call->duration ?? '' }}
                    </td>
    
                </tr>
                    @endforeach
                </tbody>
	    </table>

        </div>
    </div>
@endsection

@section('extra-js')
    <script src="{{ asset('dashboard/plugins/datatables/datatable.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
 		'pageLength': 1000,
            });

        });
    </script>
@endsection

