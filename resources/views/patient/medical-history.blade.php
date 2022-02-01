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
                <i class="fa fa-user-circle-o fa-2x"></i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Medical History of - {{$patient->firstname}} {{$patient->lastname}}</h4>
                <div class="row">
                    <div class="col-md-4">
                        <center>
                        <img width="200px"
                        src="https://ui-avatars.com/api/?rounded=true&bold=true&name= {{$patient->firstname}} +  {{$patient->lastname}}"
                             alt="">
                        </center>    
                    </div>
                    <div class="col-md-8">
                        <dl class="dl-horizontal">
                            <dt>Name</dt>
                            <dd>{{$patient->firstname}} {{$patient->lastname}}</dd>
                            <dt>Gender</dt>
                            <dd>
                                @if($patient->gender =='Male')
                                    Male
                                @elseif($patient->gender =='FeMale')
                                    Fe-Male
                                @else
                                    Other
                                @endif
                            <dt>Age</dt>
                            <dd>{{$patient->age()}}</dd>
                            <dt>Patient Number</dt>
                            <dd>{{$patient->pat_no}}</dd>
                        </dl>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h4>Consultations <a style="font-size: 15px;"
                                             href="{{url('/admin/consultation/consulte-patient-now/'.$patient->id)}}"
                                             class="pull-right"> <i class="ti ti-ink-pen"></i>New
                                             Consultation</a></h4>
                        <ul class="list-group">
                            @foreach($patient->prescriptions as $pres)
                                <li class="list-group-item"><a href="{{route('admin.home.remedies.view', $pres->id) }}"
                                                               class="btn btn-default pull-right"><i
                                                class="fa fa-eye"></i> View</a> {{$pres->created_at->format('d-M-Y')}}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('extra-js')

@endsection