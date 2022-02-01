@extends('layouts.app')


@section('title')
    Create Permissions
@endsection


@section('breadcrumb')
    <li class="float-left">
        <a href="{{url('/')}}" class="">Home</a>&nbsp;/&nbsp;
    </li>
    <li class="float-left">
        <a href="{{ route("admin.permissions.index") }}" class="">Permissions</a>/&nbsp;
    </li>
    <li class="float-left">
      New Permission
    </li>
@endsection

@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header card-header-icon">
            <i class="icon icon-pill"></i>
        </div>
        <div class="card-content">
            <h4 class="card-title"> {{ trans('global.create') }} {{ trans('cruds.permission.title_singular') }}</h4>
            <form action="{{ route("admin.permissions.store") }}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group-custom">
                    <input type="text" name="name" required="required" autofocus/>
                    <label class="control-label">{{ trans('cruds.permission.fields.title') }} &nbsp;*</label><i class="bar"></i>
                </div>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit &nbsp; </button>
                <button type="reset" class="btn btn-danger waves-effect waves-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
@endsection