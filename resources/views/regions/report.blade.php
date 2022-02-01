@extends('layouts.app')

@section('title')
Location Reports
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
            <h4 class="card-title">Location Reports</h4>
            <form action="#" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-custom ">
                            <select class="form-control select2" name="report_type" id="report_type">
                                <option value="t_patient_all_regions">Total patients all regions</option>
                                <option value="t_patient_per_region">Total patients per region</option>
                                <option value="t_doctor_all_regions">Total doctors all regions</option>
                                <option value="t_doctor_per_region">Total doctors per region</option>
                            </select>
                            <label class="control-label">Report Type &nbsp;*</label><i class="bar"></i>
                        </div>
                    </div>
                    <div class="col-md-3" id="region" style='display: none;'>
                        <div class="form-group-custom">
                            <select class="form-control select2" name="region" id="region_val">
                                @foreach($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                            <label class="control-label">Region</label><i class="bar"></i>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-success waves-effect waves-light" onclick="PreviewReport()">Preview Report &nbsp; </button>
              
            </form>
            <br><br>

        </div>
    </div>


    <center>
        <div class="center-block" id='loader' style='display: none;'>
            <img src='{{ asset('images/loading.gif')}}' width='50px' height='50px'>
        </div>
    </center>
    <div class="card" id="showdataPatientAll" style='display: none;'>
        <table id="patients_all_regions" class="table table-bordered table-striped table-hover datatable datatable-User">
            <thead>
                <tr>
                    <th>Region</th>
                    <th>Total Patients</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="card" id="showdataPatientRegion" style='display: none;'>
        <table id="patients_per_region" class="table table-bordered table-striped table-hover datatable datatable-User">
            <thead>
                <tr>
                    <th>Region</th>
                    <th>District</th>
                    <th>Total Patients</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="card" id="showdataDoctorAll" style='display: none;'>
        <table id="doctors_all_regions" class="table table-bordered table-striped table-hover datatable datatable-User">
            <thead>
                <tr>
                    <th>Region</th>
                    <th>Total Doctors</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="card" id="showdataDoctorRegion" style='display: none;'>
        <table id="doctors_per_region" class="table table-bordered table-striped table-hover datatable datatable-User">
            <thead>
                <tr>
                    <th>Region</th>
                    <th>District</th>
                    <th>Total Doctors</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('extra-js')
<script src="{{url('/dashboard/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('dashboard/plugins/datatables/datatable.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">

    function PreviewReport() {
        if ($("#report_type").val() == "t_patient_all_regions") {
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.location.report.total_patients_all_regions') }}",
                data: {},
                beforeSend: function() {
                    $("#loader").show();
                    $("#showdataPatientAll").hide();
                    $("#showdataDoctorAll").hide();
                    $("#showdataPatientRegion").hide();
                    $("#showdataDoctorRegion").hide();
                },
                success: function(response) {
                    var dataTable = $("#patients_all_regions").DataTable();
                    dataTable.clear().draw();
                    var resultData = response.data;
                    $.each(resultData, function(index, row) {
                        dataTable.row.add([
                            row.region_name,
                            row.total_patients
                        ]).draw();
                    })
                },
                complete: function(data) {
                    // Hide image container
                    $("#loader").hide();
                    $("#showdataPatientAll").show();
                    $("#showdataDoctorAll").hide();
                    $("#showdataPatientRegion").hide();
                    $("#showdataDoctorRegion").hide();

                }
            })
        } else if ($("#report_type").val() == "t_patient_per_region") {
            var region = $("#region_val").val();            
        var url = "{{ route('admin.location.report.total_patients_per_region', 'id') }}";
        url = url.replace('id', region);
            $.ajax({
                type: 'GET',
                url: url,
                data: {},
                beforeSend: function() {
                    $("#loader").show();
                    $("#showdataPatientAll").hide();
                    $("#showdataDoctorAll").hide();
                    $("#showdataPatientRegion").hide();
                    $("#showdataDoctorRegion").hide();
                },
                success: function(response) {
                    var dataTable = $("#patients_per_region").DataTable();
                    dataTable.clear().draw();
                    var resultData = response.data;
                    $.each(resultData, function(index, row) {
                        dataTable.row.add([
                            row.region_name,
                            row.district_name,
                            row.total_patients
                        ]).draw();
                    })
                },
                complete: function(data) {
                    // Hide image container
                    $("#loader").hide();
                    $("#showdataPatientAll").hide();
                    $("#showdataDoctorAll").hide();
                    $("#showdataPatientRegion").show();
                    $("#showdataDoctorRegion").hide();

                }
            })
        } else if ($("#report_type").val() == "t_doctor_all_regions") {
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.location.report.total_doctors_all_regions') }}",
                data: {},
                beforeSend: function() {
                    $("#loader").show();
                    $("#showdataPatientAll").hide();
                    $("#showdataDoctorAll").hide();
                    $("#showdataPatientRegion").hide();
                    $("#showdataDoctorRegion").hide();
                },
                success: function(response) {
                    var dataTable = $("#doctors_all_regions").DataTable();
                    dataTable.clear().draw();
                    var resultData = response.data;
                    $.each(resultData, function(index, row) {
                        dataTable.row.add([
                            row.region_name,
                            row.total_doctors
                        ]).draw();
                    })
                },
                complete: function(data) {
                    // Hide image container
                    $("#loader").hide();
                    $("#showdataPatientAll").hide();
                    $("#showdataDoctorAll").show();
                    $("#showdataPatientRegion").hide();
                    $("#showdataDoctorRegion").hide();
                }
            })
        } else if ($("#report_type").val() == "t_doctor_per_region") {
            var region = $("#region_val").val();            
        var url = "{{ route('admin.location.report.total_doctors_per_region', 'id') }}";
        url = url.replace('id', region);
            $.ajax({
                type: 'GET',
                url: url,
                data: {},
                beforeSend: function() {
                    $("#loader").show();
                    $("#showdataPatientAll").hide();
                    $("#showdataDoctorAll").hide();
                    $("#showdataPatientRegion").hide();
                    $("#showdataDoctorRegion").hide();
                },
                success: function(response) {
                    var dataTable = $("#doctors_per_region").DataTable();
                    dataTable.clear().draw();
                    var resultData = response.data;
                    $.each(resultData, function(index, row) {
                        dataTable.row.add([
                            row.region_name,
                            row.district_name,
                            row.total_doctors
                        ]).draw();
                    })
                },
                complete: function(data) {
                    // Hide image container
                    $("#loader").hide();
                    $("#showdataPatientAll").hide();
                    $("#showdataDoctorAll").hide();
                    $("#showdataPatientRegion").hide();
                    $("#showdataDoctorRegion").show();

                }
            })
        }
    }

    $(document).ready(function() {
        $("#report_type").select2({
            });
        $("#report_type").on('change', function() {
            if ($("#report_type").val() == "t_patient_all_regions") {
                $("#region").val('');
                $("#region").hide();
            } else if ($("#report_type").val() == "t_patient_per_region") {
                $("#region").show();
            } else if ($("#report_type").val() == "t_doctor_all_regions") {
                $("#region").val('');
                $("#region").hide();
            } else if ($("#report_type").val() == "t_doctor_per_region") {
                $("#region").show();
            }
        });
 
        // $(window).on('load', function() {
        //     console.log("ettststs");
            if ($("#report_type").val() == "t_patient_all_regions") {
                $("#region_val").val("");
                $("#region").hide();
            } else if ($("#report_type").val() == "t_patient_per_region") {                
                $("#region_val").val("");
                $("#region").show();
            } else if ($("#report_type").val() == "t_doctor_all_regions") {
                $("#region_val").val("");
                $("#region").hide();
            } else if ($("#report_type").val() == "t_doctor_per_region") {
                $("#region_val").val("");
                $("#region").show();
            }
        // });
    });
</script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // $("#report_type").select2({});
        $('#preview_reports_datatable').DataTable({
            "searching": true,
            "lengthChange": true,
            "info": false,
            "paging": true,
        });

    });
</script>
@endsection