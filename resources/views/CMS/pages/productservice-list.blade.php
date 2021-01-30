@extends('CMS.layout.index')

@section('title', 'News')

@section('breadcrumb')
<li class="active">Product & service</li>
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
                <ul class="nav customtab nav-tabs" role="tablist">
                    <li role="presentation" class="{{\Request::is('*/product-service') ? 'active' : ''}}"><a href="{{route('productServiceList')}}"><span class="visible-xs"><i class="ti-email"></i></span><span class="hidden-xs"><b>PUBLISH</b></span></a></li>
                    <li role="presentation" class="{{\Request::is('*/product-service/draft') ? 'active' : ''}}"><a href="{{route('productServiceList')}}/draft"><span class="visible-xs"><i class="ti-export"></i></span> <span class="hidden-xs"><b>DRAFT</b></span></a></li>
                    <li role="presentation" class=""><a href="{{route('formProductService')}}/new"><span class="visible-xs"><i class="ti-export"></i></span> <span class="hidden-xs"><b>ADD NEW</b></span></a></li>
                </ul>
                <div class="white-box p-l-20 p-r-20">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="">
                                @include("CMS.include.productservice-datatable", ['datatable_flag' => $datatable_flag])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="" method="POST" id="form-delete" name="deleteproductservice">
    {{csrf_field()}}
</form>
@endsection

@push('script')
<!-- Delete news -->
<script>
$(document).ready(function(){
    $("body").on("click", ".delete-productservice", function(e){
        if(confirm("Are you sure want to delete this item?")) {
            $("#form-delete").attr("action", "{{route('deleteProductService')}}/" + $(this).data('id'));
            document.deleteproductservice.submit();
        }
    });
});
</script>
@endpush