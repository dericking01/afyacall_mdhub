@extends('layouts.app')

@section('title')
    Edit Doctor
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
                <h4 class="card-title">Edit Doctor</h4>
                <form action="{{ route("admin.doctors.update",$doctor->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH') 
                    {{ csrf_field() }}
                    <input type="hidden" name="userid" id="userid"  value={{ $doctor->user['id']}} />
                    <div class="row">
                            <div class="col-md-4">
                               <center>
                                   <div id="image-preview">
                                       <label for="image-upload" id="image-label">Doctor photo</label>
                                       <input type="file" name="image" id="image-upload" />
                                   </div>
                               </center>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <input type="text" name="firstname" value={{ $doctor->firstname }} autofocus required/>
                                            <label class="control-label">FirstName &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <input type="text" name="lastname" value={{ $doctor->lastname }} autofocus required/>
                                            <label class="control-label">LastName &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <select name="gender" id="gender">
                                                <option {{ $doctor->gender == 'Male' ? 'selected':'' }}>Male</option>
                                                <option {{ $doctor->gender == 'FeMale' ? 'selected':'' }}>Fe-male</option>
                                                <option {{ $doctor->gender == 'Other' ? 'selected':'' }}>Other</option>
                                            </select>
                                            <label class="control-label">Gender &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <input type="date" name="date_of_birth" id="date_of_birth" value={{ $doctor->date_of_birth }} required/>
                                            <label class="control-label">Date of birth &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <input type="text" name="phone" id="phone" value={{ $doctor->phone}} required/>
                                            <label class="control-label">Phone &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <input type="text" name="nationId" value={{ $doctor->nationId }} />
                                            <label class="control-label">National ID Number &nbsp;</label><i class="bar"></i>
                                        </div>
                                    </div>
                                </div>
    

                                <div class="form-group-custom">
                                    <input type="text" name="email" value={{ $doctor->user['email']}}  required/>
                                    <label class="control-label">Email</label><i class="bar"></i>
                                </div>

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


                        <h4 class="card-title">Other Informations</h4>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Educations Information</a>
                              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Additional Trainings/Skills</a>
                              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Employee Information</a>
                              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contract" role="tab" aria-controls="nav-contact" aria-selected="false">Access Information</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <br><br>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <input type="text" name="medicalSchool"  value={{$doctor->medicalSchool}} />
                                        <label class="control-label">Medical School/University Trained &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <input type="text" name="medicalRegisterNumber" value={{$doctor->medicalRegisterNumber}} />
                                        <label class="control-label">Medical Registration Number &nbsp;</label><i class="bar"></i>
                                    </div>
                                </div>
                                <br><br>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <br><br>
                                <div class="col-md-6">
                                    <br>
                               
                                        <div class="form-group-custom">
                                            <input type="text" name="effective_communication" value={{ $doctor->effective_communication}} />
                                            <label class="control-label">Effective Communication &nbsp;</label><i class="bar"></i>
                                        </div>
                                        <div class="form-group-custom">
                                            <input type="text" name="customer_care"  value={{ $doctor->customer_care}} />
                                            <label class="control-label">Customer care &nbsp;</label><i class="bar"></i>
                                        </div>

                                        <div class="form-group-custom">
                                            <input type="text" name="medical_ethics" value={{ $doctor->medical_ethics}}  />
                                            <label class="control-label">Medical Ethics &nbsp;</label><i class="bar"></i>
                                        </div>
                                        <div class="form-group-custom">
                                            <input type="text" name="telehealth" value={{ $doctor->telehealth}} />
                                            <label class="control-label">Telehealth Consultation  &nbsp;</label><i class="bar"></i>
                                        </div>
                                </div>
                                <br><br>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <br><br>
                                <div class="col-md-12">
                                    <br>
                                        <div class="form-group-custom">
                                            <input type="text" name="health_facility"  value={{ $doctor->health_facility}}  autofocus/>
                                            <label class="control-label">Name of Health Facility &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                        </div>
                                        
                                   
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group-custom">
                                                <select name="health_facility_type" id="health_facility_type" >
                                                    <option {{ $doctor->health_facility_type == 'Goverment' ? 'selected':'' }}>Goverment</option>
                                                    <option {{ $doctor->health_facility_type == 'Faith Based' ? 'selected':'' }}>Faith Based</option>
                                                    <option {{ $doctor->health_facility_type == 'Private' ? 'selected':'' }}>Private</option>
                                                    <option {{ $doctor->health_facility_type == 'Other' ? 'selected':'' }}>Other</option>
                                                </select>
                                                <label class="control-label">Type &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group-custom">
                                                <select name="section" id="section" >
                                                    <option {{ $doctor->section == 'OPD' ? 'selected':'' }}>Hospital Outpatient care (OPD)</option>
                                                    <option {{ $doctor->section == 'IPD' ? 'selected':'' }}>Hospital Inpatient care (IPD)</option>
                                                    <option {{ $doctor->section == 'Other' ? 'selected':'' }}>Other</option>
                                                </select>
                                                <label class="control-label">Section &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="form-group-custom">
                                        <input type="text" name="currentemployer_otherinfo" />
                                        <label class="control-label">Other Info &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                    </div>
    
                            </div>
                                <br><br>
                            </div>
                            <div class="tab-pane fade" id="nav-contract" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <br><br>
                               
                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <select name="roles[]" id="roles" class="form-control select2" multiple="multiple" required>
                                                @foreach($roles as $id => $roles)
                                                    <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                                                @endforeach
                                            </select>
                                            <label class="control-label">Role &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                        </div>
                                 </div>

                            </div>
                        </div>

                          <br>
                          <button type="submit" class="btn btn-primary waves-effect waves-light">Update &nbsp;</button>
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

            $("#roles").select2({
                tags: true,
                tokenSeparators: [',', ' ']
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