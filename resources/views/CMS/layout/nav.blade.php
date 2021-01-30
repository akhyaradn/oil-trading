<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="javascript:void(0)"> 
                    <b class="hidden-xs">Admin</b><span class="caret"></span> 
                </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">
                    <li><a href="{{route('formAdminSetting')}}"><i class="mdi mdi-settings"></i> Setting</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{route('logout')}}"><i class="mdi mdi-logout"></i> Logout</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>