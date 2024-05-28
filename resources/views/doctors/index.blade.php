@extends('layouts.app')


@section('title')
    All Doctors
@endsection

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/plugins/datatables/datatable.min.css') }}">
@endsection


@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header card-header-icon">
                <i class="fa fa-users fa-2x"></i>
            </div>
            <div class="card-content">
                <h4 class="card-title">All Doctors</h4>
            </div>
            <table class="table table-striped" id="datatable">
                <thead>
                    <tr>
                        <th width="5px">#</th>
                        <th width="120px">Photo</th>
                        <th>
                            Doctor Info
                        </th>
                        <th>
                            Contact Info
                        </th>

                        <th>
                            Consultations Info
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $key => $doctor)
                        <tr data-entry-id="{{ $doctor->id }}">
                            <td>
                                {{ $doctor->id ?? '' }}
                            </td>

                            <td>
                                    <img width="80px"
                                    src="https://ui-avatars.com/api/?rounded=true&bold=true&background=aace3a&color=fff&name= {{ $doctor->firstname }} +  {{ $doctor->lastname }}">
                            </td>
                            <td>
                                <p>
                                    Name : DR. {{ $doctor->firstname ?? '' }} {{ $doctor->lastname ?? '' }} <br>
				    Gender : {{ $doctor->gender ?? '' }} <br>
                                    Medical School : {{ $doctor->medicalSchool ?? '' }} <br>
                                    Health Facility : {{ $doctor->health_facility ?? '' }} <br>
                                    Section : {{ $doctor->section ?? '' }} <br>
                                </p>
                            </td>

                            <td>
                                <p>
                                    Email : {{ $doctor->user['email'] }} <br>
                                    Phone : {{ $doctor->phone }} <br>
                                    Nation ID : {{ $doctor->nationId }} <br>
                                    Region : {{ $doctor->region['name'] }} <br>
                                    District : {{ $doctor->district['name'] }}

                                </p>
                            </td>

                            <td>
                                <p>
                                    Doctor Science : {{ $doctor->created_at->format('d-M-Y') }} <br>
                                    Status : {{ $doctor->user['status'] == 1 ? 'Offline' : 'Online' }} <br>

                                    Total Consultations Save: {{ $doctor->patients_count }} <br>
                                </p>

                                {{-- <a href="{{ route('admin.patient.medical.history',$doctor->id) }}"><i class="fa fa-eye"></i> &nbsp; View Your Patient History</a> <br> --}}
                            </td>
                            <td>

                                <div class="btn-group ">
                                    <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-primary"><i
                                            class="ti-pencil-alt"></i></a>
                                    <a href="{{ route('admin.doctors.show', $doctor->id) }}" class="btn btn-success"><i
                                            class="fa fa-info"></i></a>
                                </div>

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

            });

        });
    </script>
@endsection
