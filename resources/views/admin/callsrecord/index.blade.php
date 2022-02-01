@extends('layouts.app')


@section('title')
    CDR 
@endsection

@section('extra-css')
<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/select.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/colreorder/1.5.4/css/colReorder.dataTables.min.css">
@endsection


@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header card-header-icon">
            <i class="fa fa-users fa-2x"></i>
        </div>
        <div class="card-content">
            <h4 class="card-title">CDR Reports</h4>
        </div>
        <table class="table table-striped" id="cdrtable">
            <thead>
                <tr>
                    <th>Date / Time</th>
                    <th>Caller ID</th>
                    <th>To</th>
                    <th>Doctor Name</th>
                    <th>Duration</th>
                    <th>Talk Time</th>
                    <th>Remained Time</th>
                    <th>Disconnect</th>
                </tr>
            </thead>
            <tbody>
                @foreach($calls as $key => $call)
                <tr data-entry-id="{{ $call->id }}">
                <td>
                    {{ $call->call_date ?? '' }}
                </td>
                <td>
                    {{ $call->call_number ?? '' }}
                </td>
                <td>
                    {{ $call->doctor['phone'] ?? '' }}
                </td>
                <td>
                   Dr.  {{ $call->doctor_id ?? '' }} 
                </td>
                <td>
                    {{ $call->call_duration ?? '' }}
                </td>
                <td>
                    {{ $call->call_talktime ?? '' }}
                </td>
                <td>
                    {{ $call->channel ?? '' }}
                </td>
                <td>
                    {{ $call->call_disconnection ?? '' }}
                </td>
            </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('extra-js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.5.4/js/dataTables.colReorder.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
   <script>
        $(document).ready( function () {
                $('#cdrtable').DataTable({
                    dom: 'Bfrtip',
                    order: [[ 0, "desc" ]],
                    buttons: [
                        {
                            extend: 'collection',
                            text: 'Export',
                            buttons: [
                                'excel',
                                'csv',
                                'pdf',
                            ]
                        }
                    ]
                });
          });
    </script>
@endsection

