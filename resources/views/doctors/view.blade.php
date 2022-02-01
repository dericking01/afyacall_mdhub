@extends('layouts.app')

@section('title')
    Doctor Informations
@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{url('/dashboard/plugins/datatables/datatable.min.css')}}">
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header card-header-icon">
                <i class="fa fa-user-md"></i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Doctor Informations</h4>
                <ul class="nav nav-tabs tabs">
                    <li class="tab">
                        <a href="ui-tabs.html#drug-type" data-toggle="tab" aria-expanded="false">
                            All Patients Consultated
                        </a>
                    </li>
                    <li class="tab">
                        <a href="ui-tabs.html#education" data-toggle="tab" aria-expanded="false">
                            Education Informations
                        </a>
                    </li>
                    <li class="tab">
                        <a href="ui-tabs.html#training" data-toggle="tab" aria-expanded="true">
                            Training skills
                        </a>
                    </li>
                  
                    <li class="tab">
                        <a href="ui-tabs.html#resetpassword" data-toggle="tab" aria-expanded="false">
                            Reset doctor password
                        </a>
                    </li>
                    <li class="tab">
                        <a href="ui-tabs.html#print-setup" data-toggle="tab" aria-expanded="false">
                            Receive Call
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    @include('doctors.tab-body.patient')
                    @include('doctors.tab-body.education')
                    @include('doctors.tab-body.training')
                    @include('doctors.tab-body.online')
                    @include('doctors.tab-body.resetpassword') 
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script src="{{url('/dashboard/plugins/datatables/datatable.min.js')}}"></script>
    <script>
            $(document).ready(function () {
                $("#typeTable").dataTable({
            });

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
               $("#adminchangestatus").on("change",function (e) {     
                   var status = this.checked ? 0 : 1;
                   var id = $('#doctorid').val();
                   var doctorname = $('#doctorname').val();
                   e.preventDefault();
                   $.ajax({
                       type:'post',
                       url:'{{route('admin.user.admin_change_status')}}',
                       data: { status: status,id:id },
                       success:function (data) {
                           $.Notification.notify('success','top right',"Dr. "+doctorname+ " status has been Changes Successfully");
                       },error:function (data) {
                        $.Notification.notify('error','top right',"Contact the admin there is any error occuring ");
                       }
                   });
    
                });
            });
    </script>
   
@endsection