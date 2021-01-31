@extends('CMS.layout.index')

@section("content")
<div class="row">    
    @if($message)
    <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12 mail_listing">
        <div class="white-box">
        <div class="media m-b-30 p-t-20">
            <h4 class="font-bold m-t-0">{{$message->nama}}</h4> - <h4>{{$message->company_name}}</h4>
            <hr>
            <div class="media-body"> <span class="media-meta pull-right">{{date("d M Y H:i",strtotime($message->created_at))}}</span>
                <h4 class="text-danger m-0">Email : {{$message->email}}</h4>
                <h4 class="text-danger m-0">Contact : {{$message->contact}}</h4>
            </div>
        </div>
        {{$message->message}}
        <hr>
        </div>
    </div>
    @endif
</div>
@endsection