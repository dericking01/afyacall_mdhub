
@extends('layouts.app')


@section('title')
    Edit Permissions
@endsection


@section('breadcrumb')
    <li class="float-left">
        <a href="{{url('/')}}" class="">Home</a>&nbsp;/&nbsp;
    </li>
    <li class="float-left">
        <a href="{{ route("admin.permissions.index") }}" class="">Permissions</a>/&nbsp;
    </li>
    <li class="float-left">
      Edit Permission
    </li>
@endsection

@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header card-header-icon">
            <i class="icon icon-pill"></i>
        </div>
        <div class="card-content">
            <h4 class="card-title"> Edit Permission </h4>
            <form action="{{ route("admin.permissions.update", [$permission->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
     
                    <div class="form-group-custom">
                        <input type="text" id="name" name="name" value="{{ old('name', isset($permission) ? $permission->name : '') }}" required>
                        <label class="control-label">{{ trans('cruds.permission.fields.title') }} &nbsp;*</label><i class="bar"></i>
                    </div>
                   
                <div>
                    <input class="btn btn-danger" type="submit" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection