@extends('layouts.app')


@section('title')
    All Symptoms
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
            <a href="{{route('admin.illnesses.create')}}" class="btn btn-success pull-right" style="margin-left: 10px;">New Symptom</a> 
            <a class="btn btn-success pull-right"  data-toggle="modal" data-target="#importModal" data-backdrop="static" data-keyboard="false">Import Symptoms</a>
            <h4 class="card-title">All Symptoms</h4>
        </div>
        <table class="table table-striped" id="datatable">
            <thead>
                <tr>
                    <th width="5px">#</th>
                    <th>
                        Symptoms Name 
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
                @foreach($symptoms as $key => $symptom)
                    <tr data-entry-id="{{ $symptom->id }}">
                        <td>
                            {{ $symptom->id ?? '' }}
                        </td>
                    
                        <td>
                            {{ $symptom->symptoms_name ?? '' }} 
                        </td>
                       
                        <td>
                            {{ $symptom->status ==1 ? 'Active' : "in-Active" }} 
                        </td>
                        <td>

                            <a class="btn btn-xs btn-info" href="#">
                                {{ trans('global.edit') }}
                            </a>

                            <form action="{{ route('admin.illnesses.destroy', $symptom->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.symptoms.import') }}" method="POST" enctype="multipart/form-data">
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

