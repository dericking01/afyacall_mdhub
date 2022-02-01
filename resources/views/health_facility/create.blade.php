@extends('layouts.app')

@section('title')
    New Patient
@endsection
@section('extra-css')
<link rel="stylesheet" href="{{asset('dashboard/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('dashboard/plugins/jquery-ui/jquery-ui.css')}}">
@endsection

@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header card-header-icon">
                <i class="fa fa-user-circle-o fa-2x"></i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Add new Health Facility</h4>
                <form action="{{ route("admin.patients.store") }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group-custom">
                                        <input type="text" name="name" required="required" autofocus/>
                                        <label class="control-label">Name &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group-custom">
                                        <input type="text" name="name" required="required" autofocus/>
                                        <label class="control-label">Owner &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <input type="text" name="name" required="required" autofocus/>
                                        <label class="control-label">Name of Doctor In-charge &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                    </div>
                                </div>
                        
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <input type="text" name="name" required="required" autofocus/>
                                        <label class="control-label">Qualification of the officer in charge &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <input type="text" name="name" required="required" autofocus/>
                                        <label class="control-label">Registration number (if facility previously registered)&nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <select class="form-control select2" id="healthunit" name="healthunit">
                                            <option value="No">Select type of Health Unit</option>
                                            <option value="Medical Clinic">Medical Clinic</option>
                                            <option value="Dental clinic">Dental clinic</option>
                                            <option value="Nursing Home">Nursing Home</option>
                                            <option value="Maternity Home">Maternity Home</option>
                                            <option value="Dispensary">Dispensary</option>
                                            <option value="Health Center">Health Center</option>
                                            <option value="Hospital">Hospital</option>
                                        </select>
                                        <label class="control-label">Type of Health Unit &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-custom">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <select class="form-control select2" name="region" id="region">
                                                @foreach($regions as $key => $region)
                                                  <option value="{{ $key }}">{{ $region }}</option>
                                                @endforeach
                                            </select>
                                            <label class="control-label">Region &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <select class="form-control select2" name="districts" id="districts">
                                               
                                            </select>
                                            <label class="control-label">Districts &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                    </div>


                        <h4 class="card-title">Other Informations</h4>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Service offered</a>
                              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Ministry of Health decision</a>
                              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Staff Information</a>
                              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contract" role="tab" aria-controls="nav-contact" aria-selected="false">Contract Information</a>
                            </div>
                        </nav>
                          <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <br><br>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <select class="form-control select2" id="service" name="service[]" multiple>
                                            <option value="No">Select Service</option>
                                            <option value="General outpatient services">General outpatient services</option>
                                            <option value="Maternal and Child health services">Maternal and Child health services</option>
                                            <option value="Laboratory">Laboratory</option>
                                            <option value="Dental">Dental</option>
                                            <option value="Observation services">Observation services</option>
                                            <option value="Minor surgeries">Minor surgeries</option>
                                            <option value="Ultrasound">Ultrasound</option>
                                        </select>
                                        <label class="control-label">Services &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <input type="text" name="other_services"/>
                                        <label class="control-label">Others</label><i class="bar"></i>
                                    </div>
                                </div>
                                <br><br>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <br><br>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <input type="text" name="name" required="required" autofocus/>
                                        <label class="control-label">Application ref. No&nbsp;</label><i class="bar"></i>
                                    </div>
                                </div>

                                <br>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <input type="text" name="name" required="required" autofocus/>
                                        <label class="control-label">conditions&nbsp;</label><i class="bar"></i>
                                    </div>
                                </div>

                                <br><br>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <br><br>
                                <br><br>
                            </div>
                            <div class="tab-pane fade" id="nav-contract" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
                          </div>

                          <br>
                          <button type="submit" class="btn btn-primary waves-effect waves-light">Save &nbsp;</button>
                          <button type="reset" class="btn btn-danger waves-effect waves-light">Cancel</button>
                  
                </form>
            </div>
        </div>
    </div>
    {{-- @include('user.doctor.patient.modal.success-modal') --}}
@endsection


@section('extra-js')
    <script src="{{asset('dashboard/js/jquery.hotkeys-0.7.9.min.js')}}"  type="text/javascript"></script>
    <script src="{{asset('dashboard/plugins/select2/js/select2.min.js')}}"  type="text/javascript"></script>
    <script src="{{asset('dashboard/plugins/jquery-ui/jquery-ui.js')}}"  type="text/javascript"></script>
    <script>
        $(document).ready(function () {

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

            $("#healthunit").select2({
            });

            $("#service").select2({
            });

             // get District names on change Region
             $("#region").on('change', function () {
                console.log("Change");
                var id = $("#region").val();

                $.ajax({
                   type:'post',
                   url:'{{route('admin.region.get_disctricts')}}',
                   data: { id: id },
                   success:function (data) {
                    var len = data.data.length;
                    $("#districts").empty();
                    $("#ward").empty();
                     for( var i = 0; i<len; i++){
                            var id =  data.data[i]['id'];
                            var name =  data.data[i]['text'];     
                            $("#districts").append(
                                "<option value='"+id+"'>"+name+"</option>");
                     }
                    
                   },error:function (data) {
                       
                   }
               });
            });
        });
    </script>
@endsection