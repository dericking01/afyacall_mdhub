@extends('layouts.app')

@section('title')
    Create Consultations
@endsection


@section('extra-css')
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
@endsection

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon">
                <i class="ti-write" style="font-size: 30px;"></i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Edit Consultation</h4>
            </div>
            <form action="{{ route('admin.home.update_remedies', $prescriptions->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH') 
                {{ csrf_field() }}
                <div class="col-md-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif


                    <div class="row">

                        <div class="col-md-4">
                            <br>
                            <div class="col-md-12">
                                <div class="form-group-custom">
                                    <select class="form-control select2" id="patientSelected" name="patientSelected"
                                        required>
                                        @foreach ($patients as $patient)
                                            <option value="{{ $patient->id }}" {{ $patient->id == $prescriptions->patient_id ? 'selected' : '' }}> {{ $patient->lastname }} | <span> {{ $patient->pat_no }}</span></option>
                                        @endforeach


                                    </select>
                                    <label class="control-label">Select Patient &nbsp;<span
                                            class="text-danger">*</span></label><i class="bar"></i>
                                </div>
                            </div>

                            <br>

                            <div class="col-md-12">
          
                                <div class="card" id="showdata_of_patient" style='display: none;'>
                                    <div class="card-body">
                                        <div class="box-body">
                                            <dl class="row">
                                                <dt class="col-md-6">
                                                    <h6> First Name </h6>
                                                </dt>
                                                <dd class="col-md-6">
                                                    <h6 id="_firstname"></h6>
                                                </dd>
                                                <dt class="col-md-6">
                                                    <h6>Last Name </h6>
                                                </dt>
                                                <dd class="col-md-6">
                                                    <h6 id="_lastname"></h6>
                                                </dd>
                                                <dt class="col-md-6">
                                                    <h6>Email</h6>
                                                </dt>
                                                <dd class="col-md-6">
                                                    <h6 id="_email"></h6>
                                                </dd>
                                                <dt class="col-md-6">
                                                    <h6>Gender</h6>
                                                </dt>
                                                <dd class="col-md-6">
                                                    <h6 id="_gender"></h6>
                                                </dd>

                                                <dt class="col-md-6">
                                                    <h6>Phone Number </h6>
                                                </dt>
                                                <dd class="col-md-6">
                                                    <h6 id="_phone"></h6>
                                                </dd>
                                                <dt class="col-md-6">
                                                    <h6>Region </h6>
                                                </dt>
                                                <dd class="col-md-6">
                                                    <h6 id="_region"></h6>
                                                </dd>

                                                <dt class="col-md-6">
                                                    <h6>District </h6>
                                                </dt>
                                                <dd class="col-md-6">
                                                    <h6 id="_district"></h6>
                                                </dd>

                                            </dl>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <br>
                        </div>

                        <div class="col-md-7">
                            <br>
                            <input type="hidden" value="{{$prescriptions->patient_id}}" name="patient_id" id="patient_id">
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group-custom">
                                        <select class="form-control select2" id="callers" name="callers">
                                            <option value="Not Set">Select One</option>
                                            <option value="caller">Caller</option>
                                            <option value="repre_caller">Representing another person</option>
                                        </select>
                                        <label class="control-label">Caller </label><i class="bar"></i>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group-custom">
                                        <select class="form-control select2" id="dangersign" name="dangersign">
                                            <option value="Not Set" {{ $prescriptions->dangersign == 'Not Set' ? 'selected' : '' }}>No</option>
                                            <option value="loss of consciousness" {{ $prescriptions->dangersign == 'loss of consciousness' ? 'selected' : '' }}>loss of consciousness</option>
                                            <option value="altered mental state" {{ $prescriptions->dangersign == 'altered mental state' ? 'selected' : '' }}>altered mental state</option>
                                            <option value="chocking/blocked airways" {{ $prescriptions->dangersign == 'chocking/blocked airways' ? 'selected' : '' }}>chocking/blocked airways</option>
                                            <option value="severe respiratory distress" {{ $prescriptions->dangersign == 'severe respiratory distress' ? 'selected' : '' }}>severe respiratory distress</option>

                                        </select>
                                        <label class="control-label">Select Signs </label><i class="bar"></i>
                                    </div>
                                </div>
                            </div>

                            <div id="hidedatatofill">

                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group-custom">
                                            <input type="text" id="cheif_complaint" name="cheif_complaint" value="{{$prescriptions->cheif_complaint}}" autocomplete="off"/>
                                            <label class="control-label">Chief Complaints</label><i
                                                class="bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group-custom">
                                            <input type="text" id="hist_pres_ill" name="hist_pres_ill" value="{{$prescriptions->hist_pres_ill}}" autocomplete="off" />
                                            <label class="control-label">History of Presenting Illness </label><i
                                                class="bar"></i>
                                        </div>
                                    </div>
                                </div>


                                <br>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <select class="form-control select2" id="medication_status"
                                                name="medication_status">
                                                <option value="Not Set">Select </option>
                                                <option value="Yes">YES</option>
                                                <option value="No">NO</option>
                                            </select>
                                            <label class="control-label">Dose</label><i class="bar"></i>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <input type="text" id="medication_name" name="medication_name" />
                                            <label class="control-label">Medication</label><i class="bar"></i>
                                        </div>
                                    </div>

                                </div>


                                <br>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <select class="form-control select2" id="surgeries" name="surgeries">
                                                <option value="No">Select Surgery</option>
                                                <option value="Appendectomy">Appendectomy</option>
                                                <option value="Breast biopsy">Breast biopsy</option>
                                                <option value="Carotid endarterectomy">Carotid endarterectomy</option>
                                                <option value="Cataract surgery">Cataract surgery</option>
                                                <option value="Cesarean section">Cesarean section</option>
                                                <option value="Cholecystectomy">Cholecystectomy</option>
                                            </select>
                                            <label class="control-label">Surgery</label><i class="bar"></i>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <input type="text" id="sugreries_reaction" name="sugreries_reaction" />
                                            <label class="control-label">Sugreries Reaction</label><i
                                                class="bar"></i>
                                        </div>
                                    </div>

                                </div>



                                <br>
                                <div id="forfemale" style='display: none;'>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-custom">
                                                <input type="date" id="lastdatemens" name="lastdatemens" />
                                                <label class="control-label">Date of Last Menstrual Cycle</label><i
                                                    class="bar"></i>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group-custom">
                                                <input type="text" id="number_pregnance" name="number_pregnance" />
                                                <label class="control-label">Total Number of Pregnancies</label><i
                                                    class="bar"></i>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group-custom">
                                                <input type="text" name="number_live_birth" />
                                                <label class="control-label">Number of Live Births</label><i
                                                    class="bar"></i>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-custom">
                                                <input type="text" name="preg_complication" />
                                                <label class="control-label">Pregnancy Complications</label><i
                                                    class="bar"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group-custom">
                                            <input type="text" name="prov_diagnos" value="{{$prescriptions->prov_diagnos}}" />
                                            <label class="control-label">Provisional Diagnosis</label><i
                                                class="bar"></i>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group-custom">
                                            <textarea id="dd" name="dd" value="{{$prescriptions->dd}}" ws="3"></textarea>
                                            <label class="control-label">Differential Diagnosis</label><i
                                                class="bar"></i>
                                        </div>
                                    </div>
                                </div>


                            </div>


                            <h4> <strong>Plan of Management</strong> </h4>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group-custom">
                                        <input type="text" name="referral" value="{{$prescriptions->referral}}" />
                                        <label class="control-label">Referral</label><i class="bar"></i>
                                    </div>

                                    <div class="form-group-custom">
                                        <input type="text" name="counc_advice" value="{{$prescriptions->counc_advice}}"/>
                                        <label class="control-label">Counselling and Advice</label><i
                                            class="bar"></i>
                                    </div>

                                    <div class="form-group-custom">
                                        <input type="text" name="other_plans" value="{{$prescriptions->other_plans}}" />
                                        <label class="control-label">Others</label><i class="bar"></i>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group-custom">
                                        <select class="form-control select2" id="conclusion" name="conclusion">
                                            <option value="Call Ended Successfully" {{ $prescriptions->conclusion == 'Call Ended Successfully' ? 'selected' : '' }}>Call Ended Successfully</option>
                                            <option value="Network Problem" {{ $prescriptions->conclusion == 'Network Problem' ? 'selected' : '' }}>Network Problem</option>
                                            <option value="Patient End Call" {{ $prescriptions->conclusion == 'Patient End Call' ? 'selected' : '' }}>Patient End Call</option>
                                        </select>
                                        <label class="control-label">Call Outcomes </label><i class="bar"></i>
                                    </div>
                                </div>
                            </div>



                            <button type="submit" class="btn btn-success btn-lg pull-right"> Update </button>

                            <br><br>
                            <br><br>

            </form>

        </div>
    </div>
    </div>
    </div>
    </div>

    {{-- @include('home_remedies.model.new-patient')
    @include('home_remedies.model.representative') --}}

@endsection

@section('extra-js')
    <script src="{{ asset('dashboard/js/jquery.hotkeys-0.7.9.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dashboard/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('dashboard/plugins/jquery-ui/jquery-ui.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
     
            // Select Region
            $("#region").select2({
                placeholder: "Select Region"
            });

            $("#districts").select2({
                placeholder: "Select District"
            });

            $("#dangersign").select2({});

            // Select patient
            $("#patientSelected").select2({
                placeholder: "Patients"
            });

            // Select caller
            $("#callers").select2({});
            $("#conclusion").select2({});



            $("#dangersign").on('change', function() {
                var dangersign = $("#dangersign").val();
                if (dangersign != 'Not Set') {
                    $("#hidedatatofill").hide();
                } else {
                    $("#hidedatatofill").show();
                }

            });

            $("#callers").on('change', function() {
                var callers = $("#callers").val();
                if (callers == 'repre_caller') {
                    popuprepresentation()
                }

            });

            // Select allergic
            $("#surgeries").select2({
                placeholder: "Select Allergic"
            });


            //select dose
            $("#medication_status").select2({

            });

            // get patient details
            $("#patientSelected").on('change', function() {
                var patientId = $("#patientSelected").val();
                getPatientDetails(patientId)
            });


            // get District names on change Region
            $("#region").on('change', function() {
                var id = $("#region").val();
                $.ajax({
                    type: 'post',
                    url: '{{ route('admin.region.get_disctricts') }}',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        var len = data.data.length;
                        $("#districts").empty();
                        $("#ward").empty();
                        for (var i = 0; i < len; i++) {
                            var id = data.data[i]['id'];
                            var name = data.data[i]['text'];
                            $("#districts").append(
                                "<option value='" + id + "'>" + name + "</option>");
                        }
                    },
                    error: function(data) {

                    }
                });
            });

            function popuprepresentation() {
                $("#representative").modal('show');
            }

            function getPatientDetails(patientId) {
                $.ajax({
                    type: 'post',
                    url: '{{ route('admin.home.patient_data') }}',
                    data: {
                        patientid: patientId
                    },
                    success: function(data) {
                        console.log('success', data)
                        $("#nopatientselected").hide();
                        $("#showdata_of_patient").show();
                        document.getElementById("patient_id").value = data.id
                        document.getElementById("_firstname").innerHTML = data.firstname;
                        document.getElementById("_lastname").innerHTML = data.lastname;
                        document.getElementById("_email").innerHTML = data.email;
                        document.getElementById("_phone").innerHTML = data.phone;
                        document.getElementById("_gender").innerHTML = data.gender;
                        document.getElementById("_region").innerHTML = data.region['name'];
                        document.getElementById("_district").innerHTML = data.district['name'];

                        if (data.gender == 'Female') {
                            $("#forfemale").show();
                        } else if (data.gender == 'Male') {
                            $("#forfemale").hide();
                        }

                        if (data.prescriptions_count > 0) {
                            $("#errordata_claims").hide();
                            $("#data_patient_").show();
                            $.each(data.prescriptions, function(key, value) {
                                var url = '{{ route('admin.home.remedies.view', 'id') }}';
                                url = url.replace('id', +value.id);
                                var list = '<li class="list-group-item"><a href="' + url +
                                    '" class="btn btn-default pull-right"><i class="fa fa-eye"></i> View</a>' +
                                    value.created_at + '</li>';
                                $('#data_patient_ .list-group').append(list);
                            });
                        } else {
                            $("#errordata_claims").show();
                            $("#data_patient_").hide();

                        }
                    },
                    error: function(data) {
                      
                    }
                });
            }
        });
    </script>
@endsection

