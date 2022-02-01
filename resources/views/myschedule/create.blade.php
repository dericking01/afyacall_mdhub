@extends('layouts.app')


@section('title')
    Create Schedule
@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{asset('dashboard/plugins/select2/css/select2.min.css')}}">
@endsection



@section('breadcrumb')
    <li class="float-left">
        <a href="{{url('/')}}" class="">Home</a>&nbsp;/&nbsp;
    </li>
    <li class="float-left">
        <a href="{{ route("admin.permissions.index") }}" class="">Schedule</a>/&nbsp;
    </li>
    <li class="float-left">
      New Schedule
    </li>
@endsection

@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header card-header-icon">
            <i class="fa fa-calendar fa-2x"></i>
        </div>
        <div class="card-content">
            <h4 class="card-title"> Create Schedule</h4>
            <form action="{{ route("admin.myschedule.store") }}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
          
                <div class="form-group-custom">
                    <input type="date" name="date" required="required"/>
                    <label class="control-label">Date &nbsp;*</label><i class="bar"></i>
                </div>
            

              
                <div class="form-group-custom">
                    <input type="time" required="required" name="start_time"/>
                    <label class="control-label">Start Time</label><i class="bar"></i>
                </div>
            
        
                <div class="form-group-custom">
                    <input type="time" required="required" name="end_time"/>
                    <label class="control-label">End Time</label><i class="bar"></i>
                </div>
   
             
              

                <button type="submit" class="btn btn-primary waves-effect waves-light">Save &nbsp; </button>
                <button type="reset" class="btn btn-danger waves-effect waves-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
    <script src="{{asset('dashboard/plugins/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
   
@endsection
