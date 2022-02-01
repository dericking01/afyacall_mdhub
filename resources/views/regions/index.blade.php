@extends('layouts.app')


@section('title')
    All Regions
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
            <a href="{{ route("admin.regions.create") }}" class="btn btn-success pull-right">New Region</a>
            <h4 class="card-title">All Regions</h4>
        </div>
        <table class="table table-striped" id="datatable">
            <thead>
                <tr>
                    <th width="5px">#</th>
                    <th width="120px">Region</th>
                    <th>Post Code</th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($regions as $key => $region)
                    <tr data-entry-id="{{ $region->id }}">
                        <td>
                            {{ $region->id ?? '' }}
                        </td>
                        <td>
                            {{ ucwords($region->name) }}
                        </td>
                        <td>
                            {{ ucwords($region->postcode) }}
                        </td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.regions.show', $region->id) }}">
                                {{ trans('global.view') }}
                            </a>

                            <a class="btn btn-xs btn-info" href="{{ route('admin.regions.edit', $region->id) }}">
                                {{ trans('global.edit') }}
                            </a>

                            <form action="{{ route('admin.regions.destroy', $region->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

