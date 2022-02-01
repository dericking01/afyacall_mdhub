<!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li class="text-muted menu-title">Navigation</li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        @can('users_manage')
                        <li><a href="{{ route("admin.dashboard") }}">All Dashboard</a></li>
                        @endcan
                        <li><a href="{{ route("admin.home") }}">My Dashboard</a></li>
                    </ul>
                </li>
                
                @can('users_manage')
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-user"></i> <span> Doctors </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                       
                        <li><a href="{{ route("admin.doctors.create") }}">New Doctor</a></li>
                      
                        <li><a href="{{ route("admin.doctors.index") }}">All Doctors</a></li>
                    </ul>
                </li>
                @endcan

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-wheelchair"></i> <span> Patients </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route("admin.patients.create") }}">New Patient</a></li>
                        <li><a href="{{ route("admin.patients.index") }}">All Patients</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-notepad"></i> <span>Consultations</span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route("admin.home.remedies.create") }}"> New Consultation</a></li>
                        <li><a href="{{ route("admin.home.remedies") }}"> All Consultations</a></li>
                    </ul>
                </li>
                @can('users_manage')
                <li class="has_sub">
                    <a href="javascript:void(0);"
                       class="waves-effect">
                        <i class="ti-pie-chart"></i> <span> Reports </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <li><a href="{{route("admin.doctor.report_home")}}">Doctors Report</a></li>
                        <li><a href="{{route("admin.patient.report_home")}}">Patients Report</a></li>
                        <li><a href="{{route("admin.location.report_home")}}">Location Reports</a></li>
                        <li><a href="{{route("admin.notification.sms")}}">Notifications</a></li>
                    </ul>
                </li>

                <li class="">
                    <a href="{{ route("admin.cdr") }}" class="waves-effect"><i class="ti-headphone"></i> <span> CDR Reports </span></a>
                </li>
                <li class="">
                    <a href="{{ route("admin.cdr.all") }}" class="waves-effect"><i class="ti-headphone"></i> <span> Customer Journey </span></a>
                </li>
                @endcan
                <li class="text-muted menu-title">Calendar</li>

                <li class="">
                    <a href="{{ route("admin.calendar") }}" class="waves-effect"><i class="ti-calendar"></i> <span> Calendar </span></a>
                </li>

                <li class="">
                    <a href="{{ route("admin.myschedule.index") }}" class="waves-effect"><i class="ti-support"></i> <span> My Schedule </span></a>
                </li>



                @can('users_manage')
                    
               
                <li class="text-muted menu-title">Settings</li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-settings"></i> <span>User Management </span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">

                        <li>
                            <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                     
                    </ul>
                </li>


                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i> <span>Health Facilities</span> <span class="menu-arrow"></span> </a>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{route("admin.healthfacility.create")}}" class="nav-link {{ request()->is('admin/healthfacility') || request()->is('admin/healthfacility/*') ? 'active' : '' }}"> New Facility</a>
                        </li>
                        <li><a href="#"> All Facilities</a></li>
                    </ul>
                </li>

                <li class="list-unstyled">
                    <a href="{{ route("admin.illnesses.index") }}" class="waves-effect"><i class="ti-panel"></i> <span> Illnesses & Conditions </span></a>
                </li>

                <li class="list-unstyled">
                    <a href="{{ route("admin.chiefcomplaint.index") }}" class="waves-effect"><i class="ti-pulse"></i> <span> Chief Complaints </span></a>
                </li>

                @endcan

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->
