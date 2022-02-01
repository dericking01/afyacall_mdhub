@extends('layouts.app')


@section('title')
    All My Schedules
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
            <a href="{{ route("admin.myschedule.create") }}" class="btn btn-success pull-right">New Schedule</a>
            <h4 class="card-title">All My Schedules</h4>
        </div>
        <table class="table table-striped" id="datatable">
            <thead>
                <tr>

                    <th>
                        Day
                    </th>
                    <th>
                        Start Time
                    </th>
                    <th>
                        End Time
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($myschedules as $key => $myschedule)
                    <tr data-entry-id="{{ $myschedule->id }}">
                        <td>
                            {{ $myschedule->date ?? '' }}
                        </td>
                        <td>
                            {{ $myschedule->start_time ?? '' }}
                        </td>
                        <td>
                            {{ $myschedule->end_time ?? '' }}
                        </td>
                        <td>
                        

                            <form action="{{ route('admin.myschedule.destroy', $myschedule->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

