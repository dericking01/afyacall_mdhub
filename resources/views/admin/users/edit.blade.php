
@extends('layouts.app')
@section('title')
Edit User
@endsection

@section('extra-css')

@endsection

@section('breadcrumb')
    <li class="float-left">
        <a href="#" class="">Home</a>&nbsp;/&nbsp;
    </li>
    <li class="float-left">
        User / &nbsp;
    </li>
    <li class="float-left">
        <a href="#" class="">Edit User</a>
    </li>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header card-header-icon">
                <i class="fa fa-user-circle-o fa-2x"></i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Edit User</h4>
                <form action="{{ route("admin.users.update", [$user->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4" style="padding-left: 81px;">
                            <div id="image-preview">
                                <label for="image-upload" id="image-label">User photo</label>
                                <input type="file" name="image" id="image-upload" />
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group-custom ">
                                <input type="text" id="name" name="name"  value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                                <label class="control-label">Name &nbsp;*</label><i class="bar"></i>
                              
                            </div>
                            <div class="form-group-custom">
                                <input type="email" id="email" name="email" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                                <label class="control-label">Email &nbsp;*</label><i class="bar"></i>
                            </div>
                            <div class="form-group-custom">
                                <input type="password" id="password" name="password" required>
                                <label class="control-label">Password &nbsp;*</label><i class="bar"></i>
                            </div>
                           
                            <div class="form-group-custom">
                                <select name="roles[]" id="roles"  multiple="multiple" required>
                                    @foreach($roles as $id => $roles)
                                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                                    @endforeach
                                </select>
                                <label class="control-label">Roles</label><i class="bar"></i>
                            </div>
                        </div>
                    </div>

                   <div style="padding-left: 35%;">
                       <button type="submit" class="btn btn-primary waves-effect waves-light">Update &nbsp; <i id="loading" class="fa fa-refresh fa-spin"></i></button>
                       <button type="reset" class="btn btn-danger waves-effect waves-light">Cancel</button>
                   </div>
                </form>
            </div>
        </div>
    </div>

@endsection