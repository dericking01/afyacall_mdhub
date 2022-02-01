@extends('layouts.app')

@section('title')
    Medical History
@endsection

@section('extra-css')
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon">
                <i class="fa fa-print fa-2x"></i>
            </div>
            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <h6> Dr. {{ $prescriptions->user['name'] }}
                        </h6>
                        <h6> Doctor Number :  {{ $prescriptions->user['phone'] ?? ' Not Set' }}
                        </h6>

                        <hr>

                        <br>

                        <h6> Patient Name : {{ $prescriptions->patient['firstname'] }}
                            {{ $prescriptions->patient['lastname'] }} </h6>
                        <h6> Patient Number : {{ $prescriptions->patient['pat_no'] }}</h6>
                        <hr>
                        <br>

                        <h6> Date : {{ $prescriptions->created_at }}</h6>
                        <div class="card" id="showdata_of_patient">
                            <div class="card-body">
                                <div class="box-body">
                                    <dl class="row">
                                        <dt class="col-md-6">
                                            <h6>Chief Complaint </h6>
                                        </dt>
                                        <dd class="col-md-6">

                                            @foreach ($prescriptions->chiefcomplaints()->pluck('name') as $prescription)
                                                <span class="badge badge-info">{{ $prescription }}</span>
                                            @endforeach
                                        </dd>
                                        <dt class="col-md-6">
                                            <h6>Provisional Diagnosis</h6>
                                        </dt>
                                        <dd class="col-md-6">
                                            @foreach ($prescriptions->symptoms()->pluck('symptoms_name') as $prescription)
                                                <span class="badge badge-info">{{ $prescription }}</span>
                                            @endforeach
                                        </dd>
                                        <dt class="col-md-6">
                                            <h6>Differential Diagnosis</h6>
                                        </dt>
                                        <dd class="col-md-6">
                                            <h6>{{ $prescriptions->dd }}</h6>
                                        </dd>
                                        <dt class="col-md-6">
                                            <h6>History of Presenting Illness</h6>
                                        </dt>
                                        <dd class="col-md-6">
                                            <h6>{{ $prescriptions->hist_pres_ill }}</h6>
                                        </dd>

                                        <dt class="col-md-6">
                                            <h6>Current Taking Medicine</h6>
                                        </dt>
                                        <dd class="col-md-6">
                                            <h6>{{ $prescriptions->medication_status }}</h6>
                                        </dd>

                                        <dt class="col-md-6">
                                            <h6>Any Surgeries</h6>
                                        </dt>
                                        <dd class="col-md-6">
                                            <h6>{{ $prescriptions->surgeries }}</h6>
                                        </dd>

                                        <dt class="col-md-6">
                                            <h6>Plan of Management </h6>
                                        </dt>
                                        <dd class="col-md-6">
                                            <h6>{{ $prescriptions->counc_advice }}</h6>
                                            <h6>{{ $prescriptions->other_plans }}</h6>
                                        </dd>


                                    </dl>
                                </div>
                            </div>
                        </div>

                        <a style="margin-top:20px;" class="btn btn-default" onclick="goBack()">
                            {{ trans('global.back_to_list') }}
                        </a>


                    </div>

                </div>


                <hr>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
