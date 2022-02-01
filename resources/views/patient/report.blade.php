@extends('layouts.app')

@section('title')
    Patient Report
@endsection

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/plugins/datatables/datatable.min.css') }}">
    <link rel="stylesheet" href="{{asset('dashboard/plugins/select2/css/select2.min.css')}}">
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header card-header-icon">
                <i class="fa fa-calendar fa-2x"></i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Patient Report</h4>
                <form action="{{ route("admin.patients.report") }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-custom ">
                                <select class="form-control select2" name="patientId" id="patientId" >
                                    <option value="0">All Patient</option>
                                    @foreach($patients as $patient)
                                        <option value="{{$patient->id}}"> {{$patient->firstname}} {{$patient->lastname}}  |  <span> {{$patient->pat_no}}</span></option>
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
                            <th>Chief Compliant</th>
                            <th>History of presenting Illness</th>
                            <th>Provision Diagnosis</th>
                            <th>Differential Diagnosis</th>
                            <th>Referral</th>
                            <th>Councelling & Advice</th>
                            <th>Doctor Name</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
        </div>
       
    </div>
@endsection

@section('extra-js')
    <script src="{{asset('dashboard/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('dashboard/plugins/datatables/datatable.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
            function PreviewReport() {
                var startDate = document.getElementById("start_date").value;
                var endDate =document.getElementById("end_date").value;
                var patientId = document.getElementById("patientId").value;
                console.log(patientId);
                $.ajax({
                    type: 'GET',
                    url:"{{ route('admin.patient.preview_report') }}",
                    data: {startDate:startDate, endDate:endDate, patientId:patientId},
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
                            var pat = row.prescriptions;
                            $.each(pat,function(index,row){
                                    dataTable.row.add([
                                    row.created_at,
                                    row.cheif_complaint,
                                    row.hist_pres_ill,
                                    row.prov_diagnos,
                                    row.dd,
                                    row.referral,
                                    row.counc_advice,
                                    row.user['name'],
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
            $("#patientId").select2({
            });
            $('#preview_reports_datatable').DataTable({
               
            });

        });
    </script>
@endsection