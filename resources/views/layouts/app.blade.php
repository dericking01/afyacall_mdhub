<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AfyaCall - @yield('title')</title>

    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/panel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/switch.css')}}">
    <script src="{{asset('dashboard/js/modernizr.min.js')}}" type="text/javascript"></script>
  
    @yield('extra-css')
</head>
<body class="fixed-left">
<div id="wrapper">

        @include('layouts.sidebar.header')
        @include('layouts.sidebar.admin')
        @include('flash-message-toast') 
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
 
</div>
<script>
    var resizefunc = [];
</script>
<script src="{{asset('dashboard/js/jquery.min.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $("#loading").hide();
    })
</script>
<!-- Bootstrap plugins -->
<script src="{{asset('dashboard/js/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/js/detect.js')}}"  type="text/javascript"></script>
<!-- <script src="{{asset('dashboard/js/fastclick.js')}}"  type="text/javascript"></script> -->
<script src="{{asset('dashboard/js/jquery.slimscroll.js')}}"  type="text/javascript"></script>
<script src="{{asset('dashboard/js/jquery.blockUI.js')}}"  type="text/javascript"></script>
<script src="{{asset('dashboard/js/waves.js')}}"  type="text/javascript"></script>
<script src="{{asset('dashboard/js/wow.min.js')}}"  type="text/javascript"></script>
<script src="{{asset('dashboard/js/jquery.nicescroll.js')}}"  type="text/javascript"></script>
<script src="{{asset('dashboard/js/jquery.scrollTo.min.js')}}"  type="text/javascript"></script>
<script src="{{asset('dashboard/plugins/notifyjs/js/notify.js')}}"  type="text/javascript"></script>
<script src="{{asset('dashboard/plugins/notifications/notify-metro.js')}}"  type="text/javascript"></script>
<script src="{{asset('dashboard/js/jquery.uploadPreview.js')}}"  type="text/javascript"></script>
<script src="{{asset('dashboard/js/jquery.core.js')}}"  type="text/javascript"></script>
<script src="{{asset('dashboard/js/jquery.app.js')}}"  type="text/javascript"></script>
<script src="{{asset('dashboard/plugins/parsleyjs/parsley.min.js')}}"  type="text/javascript"></script>
<script src="{{asset('dashboard/js/dashboard.js')}}"  type="text/javascript"></script>

<script>
    $(document).ready(function () {

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
           $("#myonoffswitch").on("change",function (e) {    
               var status = this.checked ? 0 : 1;
               console.log(status)  
               e.preventDefault();
               $.ajax({
                   type:'post',
                   url:'{{route('admin.user.change_status')}}',
                   data: { status: status },
                   success:function (data) {
                       console.log(data)
                       $.Notification.notify('success','top right',"Your Status has been Changes Successfully");
                      
                   },error:function (data) {
                   }
               });

            });
        });
</script>
<script>
    $(document).ready(function () {
        $('#passwordChangeForm').on('submit',function (e) {
            e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                url:'{{route('admin.user.change_password')}}',
                type: 'POST',
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $.Notification.notify('success', 'top right', 'Password has been changed successfully');
                    $("#change-password").modal('hide');
                }, error: function (data) {
                    console.log(data)
                    if(data.status == 422 ){
                        $(this).showValidationError(data);
                    }else if(data.status == 500){
                        $.Notification.notify('error', 'top right', 'Current password not match','Current password not match');
                    }else{
                     $.Notification.notify('error','top right','Internal server error');
                    }
                }
            });
        });
    })
</script>
@yield('extra-js')
</body>
</html>