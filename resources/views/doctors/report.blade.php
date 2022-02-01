@extends('layouts.app')

@section('title')
    Doctor Report
@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{url('/dashboard/plugins/select2/css/select2.min.css')}}">
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header card-header-icon">
                <i class="fa fa-calendar fa-2x"></i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Doctor Report</h4>
                <form action="{{ route("admin.doctors.report") }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-custom ">
                                <select class="form-control select2" name="doctor_report" id="doctor_report" >
                                    <option value="0">All Doctor</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{$doctor->id}}">Dr. {{$doctor->firstname}} {{$doctor->lastname}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group-custom">
                            <input type="date" id="start_date" value="{{$start_date}}" name="start_date"/>
                                <label class="control-label">Start Date &nbsp;*</label><i class="bar"></i>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group-custom">
                                <input type="date" id="end_date" value="{{$end_date}}" name="end_date"/>
                                <label class="control-label">End Date</label><i class="bar"></i>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success waves-effect waves-light" onclick="PreviewReport()">Preview Report &nbsp; <i id="loading" class="fa fa-refresh fa-spin"></i></button>
                    <button type="submit" class="btn btn-primary">Download Report &nbsp;</button>
                </form>
                <br><br>

            </div>
        </div>
       

          <center>
                <div class = "center-block" id='loader' style='display: none;'>
                    <img src='{{ asset('images/loading.gif')}}' width='50px' height='50px'>
                </div>
            </center>
        <div class="card" id="showdata" style='display: none;'>
                <table id="preview_reports_datatable" class="table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                        <tr>
                            <th>Created at</th>
                            <th>Patient Number</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
        </div>
       
    </div>
@endsection

@section('extra-js')
    <script src="{{url('/dashboard/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('dashboard/plugins/datatables/datatable.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
            function PreviewReport() {
                var startDate = document.getElementById("start_date").value;
                var endDate =document.getElementById("end_date").value;
                var doctorId = document.getElementById("doctor_report").value;
                console.log(doctorId);
                $.ajax({
                    type: 'GET',
                    url:"{{ route('admin.doctor.preview_report') }}",
                    data: {startDate:startDate, endDate:endDate, doctorId:doctorId},
                    beforeSend: function(){
                            $("#loader").show();     
                            $("#showdata").hide()               
                    },
                    success:function(response){
                        console.log(response);
                        var dataTable = $("#preview_reports_datatable").DataTable();
                        dataTable.clear().draw();
                        var resultData = response.data;
                        $.each(resultData,function(index,row){
                            var pat = row.patients;
                            $.each(pat,function(index,row){
                                    dataTable.row.add([
                                    row.created_at,
                                    row.pat_no,
                                    row.firstname,
                                    row.lastname,
                                    row.gender      
                                ]).draw();
                            })
                           
                        })
                    },
                    complete:function(data){
                        // Hide image container
                        $("#loader").hide();
                        $("#showdata").show();
                    
                  }
                })
            }
    </script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#doctor_report").select2({
            });
            $('#preview_reports_datatable').DataTable({
                "searching": false,
                "lengthChange": false,
                "info": false,
                "paging": false,
            });

        });
    </script>
@endsection