@extends('layouts.app')

@section('title')
Remedies Setting
@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{url('/dashboard/plugins/datatables/datatable.min.css')}}">
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header card-header-icon">
                <i class="icon icon-pill"></i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Consultation Setting</h4>
                <ul class="nav nav-tabs tabs">
                    <li class="tab">
                        <a href="ui-tabs.html#drug-type" data-toggle="tab" aria-expanded="false">
                            Patient Danger Sign
                        </a>
                    </li>
                    <li class="tab">
                        <a href="ui-tabs.html#drug-strength" data-toggle="tab" aria-expanded="false">
                            Surgies Types
                        </a>
                    </li>
                    <li class="tab">
                        <a href="ui-tabs.html#drug-dose" data-toggle="tab" aria-expanded="true">
                            Referral Hospitals
                        </a>
                    </li>
                    <li class="tab">
                        <a href="ui-tabs.html#duration" data-toggle="tab" aria-expanded="false">
                            Duration
                        </a>
                    </li>
                    <li class="tab">
                        <a href="ui-tabs.html#drug-advice" data-toggle="tab" aria-expanded="false">
                            Drug Advice
                        </a>
                    </li>
                    <li class="tab">
                        <a href="ui-tabs.html#advice" data-toggle="tab" aria-expanded="false">
                            Advice
                        </a>
                    </li>
                    <li class="tab">
                        <a href="ui-tabs.html#print-setup" data-toggle="tab" aria-expanded="false">
                            Print Setup
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    @include('admin.prescription.tab-body.danger_signs.index')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script src="{{url('/dashboard/plugins/datatables/datatable.min.js')}}"></script>
   
@endsection