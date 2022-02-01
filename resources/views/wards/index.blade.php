@extends('layouts.app')


@section('title')
    All Wards
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
            <a href="{{ route("admin.wards.create") }}" class="btn btn-success pull-right">New Ward</a>
            <h4 class="card-title">All Wards</h4>
        </div>
        <table class="table table-striped" id="datatable">
            <thead>
                <tr>
                    <th width="5px">#</th>
                    <th width="120px">Ward</th>
                    <th>District</th>
                    <th>Region</th>
                    <th>Post Code</th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($wards as $key => $ward)
                    <tr data-entry-id="{{ $ward->id }}">
                        <td>
                            {{ $ward->id ?? '' }}
                        </td>
                        <td>
                            {{ ucwords($ward->name) }}
                        </td>
                        <td>
                            {{ ucwords($ward->district->name) }}
                        </td>
                        <td>
                            {{ ucwords($ward->region->name) }}
                        </td>
                        <td>
                            {{ ucwords($ward->postcode) }}
                        </td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.wards.show', $ward->id) }}">
                                {{ trans('global.view') }}
                            </a>

                            <a class="btn btn-xs btn-info" href="{{ route('admin.wards.edit', $ward->id) }}">
                                {{ trans('global.edit') }}
                            </a>

                            <form action="{{ route('admin.wards.destroy', $ward->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

