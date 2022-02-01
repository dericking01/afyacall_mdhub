@extends('layouts.app')


@section('title')
    All Streets
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
            <a href="{{ route("admin.streets.create") }}" class="btn btn-success pull-right">New Street</a>
            <h4 class="card-title">All Streets</h4>
        </div>
        <table class="table table-striped" id="datatable">
            <thead>
                <tr>
                    <th width="5px">#</th>
                    <th width="120px">Street</th>
                    <th>Ward</th>
                    <th>District</th>
                    <th>Region</th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($streets as $key => $street)
                    <tr data-entry-id="{{ $street->id }}">
                        <td>
                            {{ $street->id ?? '' }}
                        </td>
                        <td>
                            {{ ucwords($street->name) }}
                        </td>
                        <td>
                            {{ ucwords($street->ward->name) }}
                        </td>
                        <td>
                            {{ ucwords($street->district->name) }}
                        </td>
                        <td>
                            {{ ucwords($street->region->name) }}
                        </td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.streets.show', $street->id) }}">
                                {{ trans('global.view') }}
                            </a>

                            <a class="btn btn-xs btn-info" href="{{ route('admin.streets.edit', $street->id) }}">
                                {{ trans('global.edit') }}
                            </a>

                            <form action="{{ route('admin.streets.destroy', $street->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

