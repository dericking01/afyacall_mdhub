@extends('layouts.app')

@section('title')
   Dashboard
@endsection

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="widget-panel widget-style-2 bg-white">
                    <i class="ti-calendar text-primary"></i>
                    <h2 class="m-0 text-dark counter font-600">
                      {{$today_consaltation}}
                    </h2>
                    <div class="text-muted m-t-5">Today's Consultations</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="widget-panel widget-style-2 bg-white">
                    <i class="ti-notepad text-pink"></i>
                    <h2 class="m-0 text-dark counter font-600">
                      {{$prescriptions}}
                    </h2>
                    <div class="text-muted m-t-5">Total Consultations</div>
                </div>
            </div>
        
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="widget-panel widget-style-2 bg-white">
                    <i class="fa fa-money fa-2x -directory text-info"></i>
                    <h2 class="m-0 text-dark counter font-600">
                    {{$online_doctors}}
                    </h2>
                    <div class="text-muted m-t-5">Active Doctor online</div>
                </div>
            </div>
      
        </div>
    
        <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="widget-panel widget-style-2 bg-white">
                    <i class="fa fa-users text-primary"></i>
                    <h2 id="todays_patient" class="m-0 text-dark counter font-600">
                       {{$today_patient}}
                    </h2>
                    <div class="text-muted m-t-5">Today's Patient</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="widget-panel widget-style-2 bg-white">
                    <i class="fa fa-users text-pink"></i>
                    <h2 id="total_patient" class="m-0 text-dark counter font-600">
                        {{$total_patient}}
                    </h2>
                    <div class="text-muted m-t-5">Total Patient</div>
                </div>
            </div>
       
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="widget-panel widget-style-2 bg-white">
                    <i class="fa fa-users -directory text-info"></i>
                    <h2 id="patient_latest" class="m-0 text-dark counter font-600">
                        0
                    </h2>
                    <div class="text-muted m-t-5"> New Patient Last 7 Days</div>
                </div>
            </div>
      
        </div>



        
    
    </div>
@endsection

@section('extra-js')

@endsection
