@extends('layouts.app')

@section('title')
    Edit Role
@endsection


@section('breadcrumb')
    <li class="float-left">
        <a href="{{url('/')}}" class="">Home</a>&nbsp;/&nbsp;
    </li>
    <li class="float-left">
        <a href="{{ route("admin.roles.index") }}" class="">Roles</a>/&nbsp;
    </li>
    <li class="float-left">
      Edit Role
    </li>
@endsection

@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header card-header-icon">
            <i class="icon icon-pill"></i>
        </div>
        <div class="card-content">
            <h4 class="card-title">   {{ trans('global.edit') }} {{ trans('cruds.role.title_singular') }}</h4>
            <form action="{{ route("admin.roles.update", [$role->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group-custom">
                    <input type="text" id="name" name="name" value="{{ old('name', isset($role) ? $role->name : '') }}" required>
                    <label class="control-label">{{ trans('cruds.role.fields.title') }} &nbsp;*</label><i class="bar"></i>
                </div>

                <div class="form-group-custom {{ $errors->has('permission') ? 'has-error' : '' }}">
                    <select name="permission[]" id="permission"  multiple="multiple" required>
                        @foreach($permissions as $id => $permissions)
                            <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($role) && $role->permissions()->get()->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('permission'))
                        <em class="invalid-feedback">
                            {{ $errors->first('permission') }}
                        </em>
                     @endif
                    <p class="helper-block">
                        {{ trans('cruds.role.fields.permissions_helper') }}
                    </p>
                    <label class="control-label">{{ trans('cruds.role.fields.permissions') }} &nbsp;*</label><i class="bar"></i>
                </div>

                <button type="submit" class="btn btn-primary waves-effect waves-light">Update &nbsp; </button>
                <button type="reset" class="btn btn-danger waves-effect waves-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
@endsection