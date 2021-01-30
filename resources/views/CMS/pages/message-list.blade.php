@extends('CMS.layout.index')

@section('title', 'Messages')

@section('breadcrumb')
<li class="active">Messages</li>
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
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
                <br><br>
                <ul class="nav customtab nav-tabs" role="tablist">
                    <li role="presentation" class="{{\Request::is('*/messages') ? 'active' : ''}}"><a href="{{route('messagesList')}}"><span class="visible-xs"><i class="ti-email"></i></span><span class="hidden-xs"><b>INBOX</b></span></a></li>
                    <li role="presentation" class="{{\Request::is('*/messages/trash') ? 'active' : ''}}"><a href="{{route('messagesList')}}/trash"><span class="visible-xs"><i class="ti-export"></i></span> <span class="hidden-xs"><b>TRASH</b></span></a></li>                    
                </ul>
                <div class="white-box p-l-20 p-r-20">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="">
                                @include("CMS.include.message-datatable", ['datatable_flag' => $datatable_flag])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="" method="POST" id="form-flag" name="flagmessage">
    {{csrf_field()}}
</form>
@include('CMS.include.message-modal')
@endsection

@push('script')
<!-- Move to trash message -->
<script>
$(document).ready(function(){
    $("body").on("click", ".move-to-trash", function(e){
        if(confirm("Move to trash?")) {
            $("#form-flag").attr("action", "{{route('flagMessage')}}/trash/" + $(this).data('id'));
            document.flagmessage.submit();
        }
    });

    $("body").on("click", ".delete", function(e){
        if(confirm("Delete message?")) {
            $("#form-flag").attr("action", "{{route('flagMessage')}}/delete/" + $(this).data('id'));
            document.flagmessage.submit();
        }
    });

    $("body").on("click", ".restore", function(e){
        if(confirm("Restore message?")) {
            $("#form-flag").attr("action", "{{route('flagMessage')}}/restore/" + $(this).data('id'));
            document.flagmessage.submit();
        }
    });
});
</script>
@endpush