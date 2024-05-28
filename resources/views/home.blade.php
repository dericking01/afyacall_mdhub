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
                          {{$seven_patient}} 
                    </h2>
                    <div class="text-muted m-t-5"> New Patient Last 7 Days</div>
                </div>
            </div>
      
        </div>

        @can('users_manage')
        <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="widget-panel widget-style-2 bg-white">
                    <i class="fa fa-ban text-primary"></i>
                    <h2 id="todays_patient" class="m-0 text-dark counter font-600">
                       {{$totalnonselection}}
                    </h2>
                    <div class="text-muted m-t-5">Today's No Selection</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="widget-panel widget-style-2 bg-white">
                    <i class="fa fa-user-md text-pink"></i>
                    <h2 id="total_patient" class="m-0 text-dark counter font-600">
                        {{$totaldoctor}}
                    </h2>
                    <div class="text-muted m-t-5">Today's Total Calls</div>
                </div>
            </div>
       
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="widget-panel widget-style-2 bg-white">
                    <i class="fa fa-phone -directory text-info"></i>
                    <h2 id="patient_latest" class="m-0 text-dark counter font-600">
                        {{$totalivr}}
                    </h2>
                    <div class="text-muted m-t-5">Today's Total IVR </div>
                </div>
            </div>
      
        </div>
        @endcan
    
      </div>
    </div>
@endsection

@section('extra-js')
<!-- chartist chart -->
<script src="{{asset('js/chartist-js/dist/chartist.min.js')}}"></script>
<script src="{{asset('js/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js')}}"></script>
<!-- Chart JS -->
<script src="{{asset('js/echarts/echarts-all.js')}}"></script>
<script src="{{asset('js/toast-master/js/jquery.toast.js')}}"></script>
<!-- Chart JS -->
<script src="{{asset('js/dashboard1.js')}}"></script>

@endsection
