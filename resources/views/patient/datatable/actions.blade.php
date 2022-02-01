<div class="btn-group ">
    <a href="{{ route('admin.patients.edit', $patient->id) }}" class="btn btn-primary"><i class="ti-pencil-alt"></i></a>
    @can('users_manage')
    <a href="#"
    data-toggle="modal"
    data-target="#delete"  onclick="deleteData({{$patient->id}})" class="btn btn-danger"><i class="fa fa-trash-o"></i>
   </a>
   @endcan
</div>
