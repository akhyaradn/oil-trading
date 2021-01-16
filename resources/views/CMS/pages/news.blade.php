@extends('CMS.layout.index')

@section('title', 'News editor')

@section('breadcrumb')
<li class="active">News editor</li>
@endsection

@section('content')
<div class="row">
    <form method="POST" class="form-horizontal" id="newscontent" name="submitnews" action="{{route('submitNews')}}" enctype="multipart/form-data">
    {{csrf_field()}}
        <div class="col-lg-10">
            <div class="white-box">
                <div class="row">
                    @include('CMS.include.news-title')
                </div>
                <div class="row">
                    @include('CMS.include.tinymce')
                </div>
                <div class="row">
                    @include('CMS.include.news-image')
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
<script>
var map_fields = {
    'news' : 'Content',
    'judul' : 'Title',
    'img' : 'Image'
}

$(document).ready(function(){
    $("button[type=submit]").on('click', function(e){
        e.preventDefault();
        tinyMCE.triggerSave();
        fields = serializeInput("#newscontent");
        warning = '';

        // Cek jika field konten, judul sudah terisi
        for(i in fields) {
            if(i != 'flag_active' && !fields[i]) {
                warning += "- Field '" + map_fields[i] + "' invalid value!\n";
            }
        }

        // Cek jika field img sudah terisi
        fieldimg = document.getElementById('newsimg').files.length
        if(!fieldimg) warning += "- Field 'Image' invalid value!\n";

        if(warning) {
            alert(warning);
        } else {
            document.submitnews.submit();
        }
    });
});
</script>
@endpush