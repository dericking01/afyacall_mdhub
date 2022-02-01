@extends('layouts.app')


@section('title')
    All Permissions
@endsection

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/plugins/datatables/datatable.min.css')}}">
@endsection


@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header card-header-icon">
            <i class="fa fa fa-lock fa-2x"></i>
        </div>
        <div class="card-content">
            <a href="{{ route("admin.permissions.create") }}" class="btn btn-success pull-right">New Permission</a>
            <h4 class="card-title">All Permissions</h4>
        </div>
        <table class="table table-striped" id="datatable">
            <thead>
                <tr>
                    <th>
                        {{ trans('cruds.permission.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.permission.fields.title') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $key => $permission)
                    <tr data-entry-id="{{ $permission->id }}">
                        <td>
                            {{ $permission->id ?? '' }}
                        </td>
                        <td>
                            {{ $permission->name ?? '' }}
                        </td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.permissions.show', $permission->id) }}">
                                {{ trans('global.view') }}
                            </a>

                            <a class="btn btn-xs btn-info" href="{{ route('admin.permissions.edit', $permission->id) }}">
                                {{ trans('global.edit') }}
                            </a>

                            <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

