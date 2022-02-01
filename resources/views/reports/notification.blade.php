@extends('layouts.app')

@section('title')
    Notification Report
@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{ url('/dashboard/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header card-header-icon">
                <i class="fa fa-calendar fa-2x"></i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Notification Report</h4>
                <form action="#" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group-custom">
                                <input type="date" id="start_date" value="{{ $start_date }}" name="start_date" />
                                <label class="control-label">Start Date &nbsp;*</label><i class="bar"></i>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group-custom">
                                <input type="date" id="end_date" value="{{ $end_date }}" name="end_date" />
                                <label class="control-label">End Date</label><i class="bar"></i>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group-custom">
                                <button type="button" class="btn btn-success waves-effect waves-light"
                                    onclick="PreviewReport()">Preview Report &nbsp; <i id="loading"
                                        class="fa fa-refresh fa-spin"></i></button>
                            </div>
                        </div>


                    </div>

                </form>
                <br><br>

            </div>
        </div>


        <center>
            <div class="center-block" id='loader' style='display: none;'>
                <img src='{{ asset('images/loading.gif') }}' width='50px' height='50px'>
            </div>
        </center>
        <div class="card" id="showdata" style='display: none;'>
            <table id="preview_notification"
                class="table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th>Date / Time</th>
                        <th>Mobile Number</th>
                        <th>Message</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>
@endsection

@section('extra-js')
    <script src="{{ url('/dashboard/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables/datatable.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        function PreviewReport() {
            var startDate = document.getElementById("start_date").value;
            var endDate = document.getElementById("end_date").value;
            $.ajax({
                type: 'POST',
                url: "{{ route('admin.getnotification.sms') }}",
                data: {
                    startDate: startDate,
                    endDate: endDate
                },
                beforeSend: function() {
                    $("#loader").show();
                    $("#showdata").hide()
                },
                success: function(response) {
                    console.log(response);
                    var dataTable = $("#preview_notification").DataTable();
                    dataTable.clear().draw();
                    var resultData = response.data;
                    $.each(resultData, function(index, row) {
                        dataTable.row.add([
                            row.created_at,
                            row.to,
                            row.message,
                            row.status,
                        ]).draw();
                    })
                },
                complete: function(data) {
                    // Hide image container
                    $("#loader").hide();
                    $("#showdata").show();

                }
            });

        }
    </script>

@endsection
