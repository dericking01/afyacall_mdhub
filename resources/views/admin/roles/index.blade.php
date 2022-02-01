@extends('layouts.app')

@section('title')
    All Users
@endsection

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/plugins/datatables/datatable.min.css')}}">
@endsection

@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header card-header-icon">
            <i class="fa fa-user-circle-o fa-2x"></i>
        </div>
        <div class="card-content">
            <a href="{{ route("admin.roles.create") }}" class="btn btn-success pull-right">New Role</a>
            <h4 class="card-title">All Roles</h4>
        </div>
        <table class="table table-striped" id="datatable">
            <thead>
                <tr>

                    <th>
                        {{ trans('cruds.role.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.role.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.role.fields.permissions') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $key => $role)
                    <tr data-entry-id="{{ $role->id }}">
               
                        <td>
                            {{ $role->id ?? '' }}
                        </td>
                        <td>
                            {{ $role->name ?? '' }}
                        </td>
                        <td>
                            @foreach($role->permissions()->pluck('name') as $permission)
                                <span class="badge badge-info">{{ $permission }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.roles.show', $role->id) }}">
                                {{ trans('global.view') }}
                            </a>

                            <a class="btn btn-xs btn-info" href="{{ route('admin.roles.edit', $role->id) }}">
                                {{ trans('global.edit') }}
                            </a>

                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('extra-js')
    <script src="{{asset('dashboard/plugins/datatables/datatable.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable({
              
            });
           
        });
    </script>
@endsection
