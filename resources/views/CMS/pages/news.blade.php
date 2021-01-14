@extends('CMS.layout.index')

@section('title', 'News editor')

@section('breadcrumb')
<li class="active">News editor</li>
@endsection

@section('content')
<div class="row">
    <form action="POST" class="form-horizontal">
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