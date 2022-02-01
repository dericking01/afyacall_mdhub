
<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            {{-- <a href="{{url('/')}}" class="logo"><b class="icon-c-logo">Dr</b><span>Dr. Assistant</span></a> --}}
            <!-- Image Logo here -->
            <a href="{{url('/')}}" class="logo">
            <i class="icon-c-logo"><img src="{{asset('images/newnewlog.png')}}"/></i>
            <span><img src="{{asset('dashboard/images/logo.png')}}"/></span>
            </a>
        </div>

    </div>



    <!-- Button mobile view to collapse sidebar menu -->
    <nav class="navbar-custom">

        <ul class="list-inline float-right mb-0">

            <li class="list-inline-item dropdown">
                <div class="onoffswitch" >
                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch"  @if(auth()->user()->status == 0) checked @endif >
                    <label class="onoffswitch-label" for="myonoffswitch" >
                        <span class="onoffswitch-inner" ></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
              
            </li>

            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="false" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?rounded=true&bold=true&background=aace3a&color=fff&name= {{auth()->user()->name}}"
                     alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                    @if(isset($doctor_id))
                    <a href="{{ route('admin.doctor.calls', $doctor_id) }}" class="dropdown-item notify-item">
                        <i class="zmdi zmdi-account-circle"></i> <span>My Calls</span>
                    </a>
                    @endif

                    <!-- item-->
                    <a href="#"  data-toggle="modal" data-target="#change-password" class="dropdown-item notify-item">
                        <i class="zmdi zmdi-account-circle"></i> <span>Change Password</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                       class="dropdown-item notify-item">
                        <i class="zmdi zmdi-power"></i> <span>Logout</span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </a>
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                    <i class="dripicons-menu"></i>
                </button>
            </li>

           <div class="top-bar-breadcrumb">
                @yield('breadcrumb')
           </div>

        </ul>

    </nav>

</div>
<!-- Top Bar End -->


<div id="change-password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0">Change Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="passwordChangeForm">
                    {{csrf_field()}}
                    <div class="form-group-custom">
                        <input type="password" name="password" required="required" autofocus/>
                        <label class="control-label">Current Password &nbsp;*</label><i class="bar"></i>
                    </div>
                    <div class="form-group-custom">
                        <input type="password" name="new_password" required="required" autofocus/>
                        <label class="control-label">New Password &nbsp;*</label><i class="bar"></i>
                    </div>
                    <div class="form-group-custom">
                        <input type="password" name="confirm" required="required" autofocus/>
                        <label class="control-label">Re-Type Password &nbsp;*</label><i class="bar"></i>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" onclick="$('#passwordChangeForm').submit()" class="btn btn-info waves-effect waves-light">Save changes</button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->