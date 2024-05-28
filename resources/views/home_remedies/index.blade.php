@extends('layouts.app')


@section('title')
    All Consultations
@endsection

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/plugins/datatables/datatable.min.css') }}">
@endsection


@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header card-header-icon">
                <i class="ti-write" style="font-size: 30px;"></i>
            </div>
            <div class="card-content">
                <h4 class="card-title">All Consultations</h4>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
            <table class="table table-striped" id="datatable">
                <thead>
                    <tr>
                        <th width="5px">Cons #No</th>
                        <th>Date</th>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prescriptions as $key => $prescription)
                        <tr data-entry-id="{{ $prescription->id }}">
                            <td>
                                {{ $prescription->id ?? '' }}
                            </td>

                            <td>
                                {{ $prescription->created_at }}
                            </td>

                            <td>
                                <p>
                                    Full Name : {{ $prescription->patient['firstname'] }}
                                    {{ $prescription->patient['lastname'] }} <br>
                                    Patient Number : {{ $prescription->patient['pat_no'] }}
                                </p>
                            </td>


                            <td>
                                <p>
                                    Doctor Name : Dr. {{ $prescription->user['name'] }} <br>
                                    Doctor Number : {{ $prescription->user['phone'] }}
                                </p>
                            </td>


                            <td>
                                <a class="btn btn-xs btn-info"
                                    href="{{ route('admin.home.remedies.view', $prescription->id) }}">
                                    View
                                </a>

                                @if (auth()->user()->id == $prescription->user_id)
                                <a href="{{ route('admin.home.remedies.edit', $prescription->id) }}" class="btn btn-primary"><i
                                    class="ti-pencil-alt"></i></a>

                                @endif

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('extra-js')
    <script src="{{ asset('dashboard/plugins/datatables/datatable.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                'pageLength': 25,
                order: [
                    [0, "desc"]
                ],
                buttons: [
                    'csv', 'excel', 'pdf'
                ]
            });
            $('.buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

        });
    </script>
@endsection

