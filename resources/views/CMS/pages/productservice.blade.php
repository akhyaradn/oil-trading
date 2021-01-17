@extends('CMS.layout.index')

@section('title', 'Add product & service')

@section('breadcrumb')
<li class="active">Product & service</li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-8">
        <div class="white-box">
            <form method="POST" class="form-horizontal" id="formarea" name="submitnews" action="">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-12">
                        @include('CMS.include.news-title')
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        @include('CMS.include.paragraf-textarea', ['name' => 'paragraf_awal', 'label' => 'First paragraph'])
                    </div>
                    <div class="col-lg-6">
                        @include('CMS.include.paragraf-textarea', ['name' => 'paragraf_akhir', 'label' => 'Second paragraph'])
                    </div>
                </div>
                <div class="row" id="productservicearea">
                    <div class="col-lg-12 wrap-area">
                        <h3 class="box-title m-t-40"></h3>
                        @include('CMS.include.product-service-pricing', ['name' => 'industry', 'label' => 'Industry'])
                        @include('CMS.include.product-service-pricing', ['name' => 'mining', 'label' => 'Mining'])
                        @include('CMS.include.product-service-pricing', ['name' => 'shipping', 'label' => 'Shipping'])
                    </div>
                </div>
                <button type="button" id="add-new-area" class="btn btn-outline btn-default">Add new area</button>
            </from>
        </div>
    </div>
</div>
@endsection

@push('script')
<!-- Label area -->
<script>
function renameLabelArea() {
    $.each($(".wrap-area").children("h3"), function(i){
        $(this).html("Area " + (i + 1))
    });
}

$(document).ready(function(){
    renameLabelArea();
});
</script>

<!-- Generate new area -->
<script>
var raw_area = `
<div class="col-lg-12 wrap-area">
    <h3 class="box-title m-t-40"></h3>
    @include('CMS.include.product-service-pricing', ['name' => 'industry', 'label' => 'Industry'])
    @include('CMS.include.product-service-pricing', ['name' => 'mining', 'label' => 'Mining'])
    @include('CMS.include.product-service-pricing', ['name' => 'shipping', 'label' => 'Shipping'])
</div>
`;

$(document).ready(function(){
    $("#add-new-area").on("click", function(e){
        var area = $(".wrap-area");
        var total_area = area.length;
        var fields = {
            'industry[]' : serializeInputArray("input[name='industry[]']"),
            'mining[]' : serializeInputArray("input[name='mining[]']"),
            'shipping[]' : serializeInputArray("input[name='shipping[]']")
        };
        var last_ix = fields['industry[]'].length - 1;

        if(
            fields['industry[]'][last_ix] &&
            fields['mining[]'][last_ix] &&
            fields['shipping[]'][last_ix]
        ) {
            $("#productservicearea").append(raw_area);
            renameLabelArea();
        } else {
            alert("Please fill the empty 'Area "+ (last_ix + 1) +"' inputs");
        }
    });
});
</script>
@endpush