@extends('layouts.app')


@section('title')
    CDR 
@endsection

@section('extra-css')

@endsection


@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header card-header-icon">
            <i class="fa fa-users fa-2x"></i>
        </div>
        <div class="card-content">
            <h4 class="card-title">CDR Reports</h4>
        </div>
        <table class="table table-striped" id="cdrtable">
            <thead>
                <tr>
                    <th>Date / Time</th>
                    <th>Msisdn</th>
                    <th>Reached Stage</th>
                    <th>Call OutCome</th>
                    <th>Service</th>
                    <th>Payment Status</th>
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
                    {{ $call->paymentStatus ?? '' }}
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

@endsection

