@extends('layouts.app')

@section('title')
    Edit Region
@endsection
@section('extra-css')
<link rel="stylesheet" href="{{asset('dashboard/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('dashboard/plugins/jquery-ui/jquery-ui.css')}}">
@endsection

@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header card-header-icon">
                <i class="fa fa-map-marker fa-2x"></i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Edit Region</h4>
                <form action="{{ route("admin.regions.update", $region->id) }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{ method_field('PATCH') }}
                    <div class="row" style="padding-left: 8%; padding-right: 5%;">
                        <div class="col-md-12">
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <input type="text" name="name" 
                                            value="{{ old('name') ? old('name') : $region->name }}"/>
                                            <label class="control-label">Name &nbsp;<span class="text-danger">*</span></label><i class="bar"></i>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group-custom">
                                            <input type="text" name="postcode" 
                                            value="{{ old('postcode') ? old('postcode') : $region->postcode }}"/>
                                            <label class="control-label">Post Code &nbsp;</label><i class="bar"></i>
                                        </div>
                                    </div>

                                </div>
                        </div>
                    </div>
                    <br>
                    <div style="padding-left: 5%;">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Submit &nbsp; <i id="loading" class="fa fa-refresh fa-spin"></i></button>
                        <button type="reset" class="btn btn-danger waves-effect waves-light">Cancel</button>
                    </div>
                
                </form>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script src="{{asset('dashboard/js/jquery.hotkeys-0.7.9.min.js')}}"  type="text/javascript"></script>
    <script src="{{asset('dashboard/plugins/select2/js/select2.min.js')}}"  type="text/javascript"></script>
    <script src="{{asset('dashboard/plugins/jquery-ui/jquery-ui.js')}}"  type="text/javascript"></script>
@endsection