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
                <h4 class="card-title">Add new patient</h4>
                <form action="{{ route("admin.patients.store") }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        {{-- <div class="col-md-4">
                           <center>
                               <div id="image-preview">
                                   <label for="image-upload" id="image-label">Patient photo</label>
                                   <input type="file" name="image" id="image-upload" />
                               </div>
                           </center>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <input type="text" name="firstname" required="required" autofocus/>
                                        <label class="control-label">First Name  &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <input type="text" name="lastname" required="required" autofocus/>
                                        <label class="control-label">Last Name &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <select name="gender" id="gender" required="required">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <label class="control-label">Gender &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <input type="number" name="date_of_birth" id="date_of_birth" min="1" max="100"/>
                                        <label class="control-label">Age &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <input type="text" name="phone" id="phone" required="required"/>
                                        <label class="control-label">Phone &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                        @if ($errors->has('phone'))
                                        <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <input type="text" name="otherphone" id="otherphone" />
                                        <label class="control-label">Other Phone &nbsp;</label><i class="bar"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <input type="text" name="email" id="email"/>
                                        <label class="control-label">Email</label><i class="bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <input type="text" name="pat_no" id="pat_no"  value="{{$patientnumber}}" readonly/>
                                        <label class="control-label">Patient Number </label><i class="bar"></i>
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
                                            <label class="control-label">District &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                        </div>
                    </div>
                
                    <div style="padding-left: 35%;">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Submit &nbsp; </button>
                        <button type="reset" class="btn btn-danger waves-effect waves-light">Cancel</button>
                    </div>
                
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