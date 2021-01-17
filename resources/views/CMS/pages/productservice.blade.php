@extends('CMS.layout.index')

@section('title', 'Add new product & service')

@section('breadcrumb')
<li class="active">Product & service</li>
@endsection

@section('content')
<div class="row">
    <form method="POST" class="form-horizontal" id="formarea" name="submitproductservice" action="{{route('submitProductService')}}">
    <div class="col-sm-10">
        <div class="white-box">
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
                <div class="col-lg-12 wrap-area">
                    <h3 class="box-title m-t-40"></h3>
                    @include('CMS.include.product-service-pricing', ['name' => 'industry', 'label' => 'Industry'])
                    @include('CMS.include.product-service-pricing', ['name' => 'mining', 'label' => 'Mining'])
                    @include('CMS.include.product-service-pricing', ['name' => 'shipping', 'label' => 'Shipping'])
                </div>
                <div class="col-lg-12 wrap-area">
                    <h3 class="box-title m-t-40"></h3>
                    @include('CMS.include.product-service-pricing', ['name' => 'industry', 'label' => 'Industry'])
                    @include('CMS.include.product-service-pricing', ['name' => 'mining', 'label' => 'Mining'])
                    @include('CMS.include.product-service-pricing', ['name' => 'shipping', 'label' => 'Shipping'])
                </div>
                <div class="col-lg-12 wrap-area">
                    <h3 class="box-title m-t-40"></h3>
                    @include('CMS.include.product-service-pricing', ['name' => 'industry', 'label' => 'Industry'])
                    @include('CMS.include.product-service-pricing', ['name' => 'mining', 'label' => 'Mining'])
                    @include('CMS.include.product-service-pricing', ['name' => 'shipping', 'label' => 'Shipping'])
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="white-box">
            @include('CMS.include.news-draft-publish')  
            <br><br>
            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
        </div>
    </div>
    </from>
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

<!-- Submit -->
<script>
map_fields = {
    'judul' : 'Judul',
    'paragraf_awal' : 'First paragraph',
    'paragraf_akhir' : 'Second paragraph',
    'industry[]' : 'Industry',
    'mining[]' : 'Mining',
    'shipping[]' : 'Shipping'
};

$(document).ready(function(){
    $("button[type=submit]").on("click", function(e){
        e.preventDefault();
        var warning = '';
        var fields = serializeInput("#formarea");
        fields['industry[]'] = serializeInputArray("input[name='industry[]']");
        fields['mining[]'] = serializeInputArray("input[name='mining[]']");
        fields['shipping[]'] = serializeInputArray("input[name='shipping[]']");

        console.log(fields);

        //Cek jika form kosong
        for(i in fields) {
            if(typeof(fields[i]) != 'object' || i != 'flag_active') {
                if(!fields[i])
                    warning += "- Field '" + map_fields[i] + "' invalid value!\n";
            }

            if(typeof(fields[i]) == 'object') {
                for(j = 0; j < 4; j++) {
                    if(!fields[i][j])
                        warning += "- Field '" + map_fields[i] + "' in 'Area "+(parseInt(j)+1)+"' invalid value!\n";
                }
            }
        }

        if(warning) {
            alert(warning);
        } else {
            document.submitproductservice.submit();
        }
    });
});
</script>
@endpush