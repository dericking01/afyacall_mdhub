@extends('layouts.app')


@section('title')
    All Chiefcomplaint
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
            <a href="{{route('admin.chiefcomplaint.create')}}" class="btn btn-success pull-right" style="margin-left: 10px;">New Chief Complaint</a> 
            <h4 class="card-title">All Chief Complaint</h4>
        </div>
        <table class="table table-striped" id="datatable">
            <thead>
                <tr>
                    <th width="5px">#</th>
                    <th>
                        Chief Complaint Name 
                    </th>
                   

                     <th>
                        Status
                     </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($chiefcomplaints as $key => $chiefcomplaint)
                    <tr data-entry-id="{{ $chiefcomplaint->id }}">
                        <td>
                            {{ $chiefcomplaint->id ?? '' }}
                        </td>
                    
                        <td>
                            {{ $chiefcomplaint->name ?? '' }} 
                        </td>
                       
                        <td>
                            {{ $chiefcomplaint->status == 1 ? 'Active' : "in-Active" }} 
                        </td>
                        <td>

                            <a class="btn btn-xs btn-info" href="#">
                                {{ trans('global.edit') }}
                            </a>

                            <form action="{{ route('admin.chiefcomplaint.destroy', $chiefcomplaint->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

{{-- <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.chiefcomplaints.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Symptoms</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="file" name="file" class="form-control file-import">
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-success">Import</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}
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

