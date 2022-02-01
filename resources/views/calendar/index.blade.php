@extends('layouts.app')

@section('title')
   Calendar
@endsection


@section('extra-css')
<link rel="stylesheet" href="{{asset('dashboard/calendar/css/fullcalendar.min.css')}}">
@endsection

@section('content')
  
<div class="card-body">

  

    <div id='calendar'></div>


</div>
@endsection

@section('extra-js')
    <script src="{{asset('dashboard/calendar/js/moment.min.js')}}"  type="text/javascript"></script>
    <script src="{{asset('dashboard/calendar/js/fullcalendar.min.js')}}"  type="text/javascript"></script>
    <script>
        $(document).ready(function () {
                // page is now ready, initialize the calendar...
                events={!! json_encode($events) !!};
                $('#calendar').fullCalendar({
                    // put your options and callbacks here
                    events: events,
                })
            });
    </script>
@endsection


