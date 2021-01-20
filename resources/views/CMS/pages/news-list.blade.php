@extends('CMS.layout.index')

@section('title', 'News')

@section('breadcrumb')
<li class="active">News</li>
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
            <h3 class="box-title">News</h3>
                <div class="white-box p-l-20 p-r-20">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="">
                                @include("CMS.include.news-datatable", ['datatable_flag' => $datatable_flag])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="" method="POST" id="form-delete" name="deletenews">
    {{csrf_field()}}
    <input type="hidden" name="flag_active" value="2">
</form>
@endsection

@push('script')
<!-- Delete news -->
<script>
$(document).ready(function(){
    $("body").on("click", ".delete-news", function(e){
        if(confirm("Are you sure want to delete this item?")) {
            $("#form-delete").attr("action", "{{route('deleteNews')}}/" + $(this).data('id'));
            document.deletenews.submit();
        }
    });
});
</script>
@endpush