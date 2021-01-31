@extends('CMS.layout.index')

@section('title', 'Dashboard')

@section('breadcrumb')
<li class="active">Dashboard</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-5 col-lg-5 col-sm-5">
        @if($news && count($news) > 0)
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="p-20 row">
                        <div class="col-sm-6">
                            <h4 class="m-t-0"><b>LATEST NEWS</b></h4>
                        </div>
                        <div class="col-sm-6">
                            <ul class="side-icon-text pull-right">
                                <li><a href="{{route('formNews')}}/new" class="btn btn-success waves-effect waves-light" style="color: white;"><span>New</span> <i class="mdi mdi-shape-square-plus"></i></a></li>
                                <li><a href="{{route('newsList')}}" class="btn btn-success waves-effect waves-light" style="color: white;"><span>Show all</span> <i class="mdi mdi-newspaper"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover manage-u-table">
                            <thead>
                                <tr>
                                    <th style="width: 10%;" class="text-center">#</th>
                                    <th style="width: 70%;">Title</th>
                                    <th style="width: 20%;" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($news as $v)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$v->judul}}</td>
                                    <td class="text-center">
                                    <a class="btn btn-xs btn-info" 
                                        href="{{route('formNews', ['id' => $v->id])}}"
                                        target="_blank"
                                    >Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($productservice && count($productservice) > 0)
        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="p-20 row">
                        <div class="col-sm-6">
                            <h4 class="m-t-0"><b>LATEST PRODUCT & SERVICE</b></h4>
                        </div>
                        <div class="col-sm-6">
                            <ul class="side-icon-text pull-right">
                                <li><a href="{{route('formProductService')}}/new" class="btn btn-success waves-effect waves-light" style="color: white;"><span>New</span> <i class="mdi mdi-shape-square-plus"></i></a></li>
                                <li><a href="{{route('productServiceList')}}" class="btn btn-success waves-effect waves-light" style="color: white;"><span>Show all</span> <i class="mdi mdi-widgets"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover manage-u-table">
                            <thead>
                                <tr>
                                    <th style="width: 10%;" class="text-center">#</th>
                                    <th style="width: 70%;">Title</th>
                                    <th style="width: 20%;" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productservice as $v)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$v->judul}}</td>
                                    <td class="text-center">
                                    <a class="btn btn-xs btn-info" 
                                        href="{{route('formProductService', ['id' => $v->id])}}"
                                        target="_blank"
                                    >Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    @if($messages) 
    <div class="col-md-7 col-lg-7 col-sm-7">
        <div class="white-box">
            <h3 class="box-title">Recent messages</h3>
            <div class="comment-center p-t-10">
                @foreach($messages as $v)
                <div class="comment-body">
                    <div class="mail-contnet">
                        <h5><b>{{$v->nama}}</b> - {{$v->company_name}}</h5><span class="time">{{date("d M Y H:i", strtotime($v->created_at))}}</span>
                        <br/><span class="mail-desc">{{$v->message}}</span> 
                        <!-- <a href="" class="btn btn btn-rounded btn-default btn-outline m-r-5">Detail</a> -->
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection