@extends('layouts.app')

@section('title')
Symptoms
@endsection

@section('extra-css')

@endsection

@section('breadcrumb')
    <li class="float-left">
        <a href="{{url('/')}}" class="">Home</a>&nbsp;/&nbsp;
    </li>
    <li class="float-left">
        Symptoms / &nbsp;
    </li>
    <li class="float-left">
        <a href="{{url('/new-drug')}}" class="">New Symptoms</a>
    </li>
@endsection

@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header card-header-icon">
                <i class="icon icon-pill"></i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Add new Symptoms</h4>
                <form action="{{ route("admin.illnesses.store") }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group-custom">
                        <input type="text" name="symptoms_name" required="required" autofocus/>
                        <label class="control-label">Symptoms Name &nbsp;*</label><i class="bar"></i>
                    </div>
                    <div class="form-group-custom">
                        <textarea name="symptoms_note" ></textarea>
                        <label class="control-label">Short Note</label><i class="bar"></i>
                    </div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit &nbsp; <i id="loading" class="fa fa-refresh fa-spin"></i></button>
                    <button type="reset" class="btn btn-danger waves-effect waves-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>

@endsection
