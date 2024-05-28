@extends('layouts.app')

@section('title')
    All Patient
@endsection

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/plugins/datatables/datatable.min.css') }}">
@endsection

@section('content')
    <div class="card">
        <div class="card-header card-header-icon">
            <i class="fa fa-users fa-2x"></i>
        </div>
        <div class="card-content">
            <h4 class="card-title">All Patient</h4>
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
                    <th width="5px">#</th>
                    <th>Patient Pic</th>
                    <th>Patient Info</th>
                    <th>Contact Info</th>
                    <th>Medical Info</th>
                    {{-- <th>Status</th> --}}
                    {{-- <th width="25px">Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($patients as $key => $patient)
                    <tr>
                        <td>{{ $key + $patients->firstItem() }}</td>
                        <td><img width="80px"
                                src="https://ui-avatars.com/api/?rounded=true&bold=true&background=aace3a&color=fff&name= {{ $patient->firstname }} +  {{ $patient->lastname }}">
                        </td>
                        <td>@include('patient.datatable.patient-info')</td>
                        <td>@include('patient.datatable.contact-info')</td>
                        <td>@include('patient.datatable.medical-info')</td>
                        {{-- <td>@include('patient.datatable.actions', ['id' => $patient->id])</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="Heading" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" id="deleteForm" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title custom_align" id="Heading">Delete Contact will also Delete Consultation
                            History</h4>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="alert alert-warning">
                            <span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to
                            delete this Contact?
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="submit" name="" class="btn btn-danger" data-dismiss="modal"
                            onclick="formSubmit()">Yes, Delete</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span> No
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('extra-js')
    <script src="{{ asset('dashboard/plugins/datatables/datatable.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({

	     'pageLength': 25,
            });

        });
    </script>
    <script type="text/javascript">
        function deleteData(id) {
            var id = id;
            var url = '{{ route('admin.patients.destroy', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
@endsection
