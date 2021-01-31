<!DOCTYPE html>  
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="">
<title>Prodigy</title>
<!-- Bootstrap Core CSS -->
<link href="{{asset('CMS/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
<!-- animation CSS -->
<link href="{{asset('CMS/css/animate.css')}}" rel="stylesheet">
<!-- Custom CSS -->
<link href="{{asset('CMS/css/style.css')}}" rel="stylesheet">
<!-- color CSS -->
<link href="{{asset('CMS/css/colors/default.css')}}" id="theme"  rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="new-login-register">
    <div class="lg-info-panel" style="display: none">
    </div>
    <div class="new-login-box" style="margin:auto!important;">
        <div class="white-box">
            @if(session('failed'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
                {{session('failed')}}
            </div>
            @endif
            <h3 class="box-title m-b-0">Sign In to Admin</h3>
            <small>Enter your details below</small>
            <form class="form-horizontal new-lg-form" method="POST" action="{{route('postLogin')}}" id="loginform">
                {{csrf_field()}}
                <div class="form-group  m-t-20">
                    <div class="col-xs-12">
                    <label>Username</label>
                    <input class="form-control" type="text" name="username" required="" placeholder="Username">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                    <label>Password</label>
                    <input class="form-control" type="password" name="password" required="" placeholder="Password">
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                    <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Log In</button>
                    </div>
                </div>
                </form>
           </form>
        </div>
    </div>            
</section>
<!-- jQuery -->
<script src="{{asset('CMS/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('CMS/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{asset('CMS/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>

<!--slimscroll JavaScript -->
<script src="{{asset('CMS/js/jquery.slimscroll.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('CMS/js/waves.js')}}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{asset('CMS/js/custom.min.js')}}"></script>
<!--Style Switcher -->
<script src="{{asset('CMS/plugins/bower_components/styleswitcher/jQuery.style.switcher.js')}}"></script>
</body>
</html>
