@extends('admin.master')
@section('content') {{-- master @yield(content)--}}
<h1>{{trans('admin.dashboard')}}</h1>

<div class="stats">
    <div class="row">
        <div class="col-sm-3">
            <div class=" dash dash-products">
                <b>1523</b>
                <span>Products</span>
                <i class="glyphicon glyphicon-film"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="dash dash-synch">
                <b>1523</b>
                <span>Synchronized To China</span>
                <i class="fa fa-usb"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="dash dash-trailers">
                <b>142123</b>
                <span>Trailers</span>
                <i class="fa fa-file-movie-o"></i>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="dash dash-screenings">
                <b>51223</b>
                <span>Screenings</span>
                <i class="fa fa-video-camera"></i>
            </div>
        </div>
    </div>
</div>
@stop