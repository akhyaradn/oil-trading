@extends('CMS.layout.index')

@section('title', 'Admin setting')

@section('breadcrumb')
<li class="active">Admin setting</li>
@endsection

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
    {{session('success')}}
</div>
@endif
@if(session('failed'))
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
    {{session('failed')}}
</div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="white-box">
            <h3 class="box-title m-b-0">Change password</h3>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form method="POST" action="{{route('postAdminSetting')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" name="password" id="exampleInputEmail1"> </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">New password</label>
                            <input type="password" class="form-control" name="newpassword" id="exampleInputEmail1"> </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Confirm new password</label>
                            <input type="password" class="form-control" name="confirmpassword" id="exampleInputEmail1"> </div>
                        <button type="submit" id="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
$("#submit").on("click", function(e){
    warning = '';
    pass = $("input[name=password]").val();
    newpass = $("input[name=password]").val();
    confirmpass = $("input[name=password]").val();
    
    if(!pass) warning += "- Password can't be empty\n";
    if(!newpass) warning += "- New password can't be empty\n";
    if(!confirmpass) warning += "- Confirm new password can't be empty\n";

    if(warning) {
        e.preventDefault();
        alert(warning)
    };
});
</script>
@endpush