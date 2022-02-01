<!--  Modal content for the above example -->
<style>
    .close{
        position: absolute;
        right: 0;
        top:0;
        padding: 15px;
    }
</style>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <div class="modal-body">
                <h4 class="card-title">Add new patient</h4>
                <form action="{{ route("admin.home.create_patient") }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <br>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <input type="text" name="firstname" required="required" autofocus/>
                                        <label class="control-label">FirstName &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <input type="text" name="lastname"  autofocus/>
                                        <label class="control-label">LastName &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <select name="gender" id="gender" >
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
                                        <input type="text" name="phone_mobile" id="phone_mobile" required="required"/>
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
                                        <label class="control-label">Patient Number &nbsp;</label><i class="bar"></i>
                                    </div>
                                </div>
                            </div>

                            

                           
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <select class="form-control select2" name="region" id="region" style="width: 100%;">
                                            @foreach($regions as $key => $region)
                                                <option value="{{ $key }}">{{ $region }}</option>
                                            @endforeach
                                        </select>
                                        <label class="control-label">Region &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <select class="form-control select2" name="districts" id="districts" style="width: 100%;">
                                            
                                        </select>
                                        <label class="control-label">Districts &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                    </div>
                                </div>
                            </div>
                        
                
                        </div>
                    </div>
                
                    <div style="padding-left: 5%;">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save &nbsp; <i id="loading" class="fa fa-refresh fa-spin"></i></button>
                        <button type="reset" class="btn btn-danger waves-effect waves-light">Cancel</button>
                    </div>
                
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
