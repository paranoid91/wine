@extends("Front.app")

@section("title")
<title>Products</title>
@stop

@section("css")
<style>
@media screen and (max-width: 880px) and (min-width: 820px) {
    .slick-product-item {
        padding: 0 !important;
    }
}

@media screen and (max-width: 600px){
    .slick-product-item {
        padding: 0 !important;
    }
}
</style>
@stop

@section("content")
<div id="content">
    <div class="list-wrapper">
        <div class="container list-container">
            <div class="row no-margin">
                <div class="col-md-3 col-lg-3">
                    <div class="nav-list-menu">
                        <ul class="list-unstyled">
                            <li class="active-link">
                                &nbsp;&nbsp;
                                CATEGORIES
                            </li>
                            <li>
                                &nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
                                <a href="#">White <span class="nav-ls-count">(10)</span></a>
                            </li>
                            <li>
                                &nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
                                <a href="#">Red <span class="nav-ls-count">(14)</span></a>
                            </li>
                            <li>
                                &nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
                                <a href="#">White <span class="nav-ls-count">(10)</span></a>
                            </li>
                            <li>
                                &nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
                                <a href="#">Red <span class="nav-ls-count">(14)</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 col-lg-9 no-padding">
                @if(count($products)>0)
                    @include("Front/main_parts/slick-control", ["title"=>"NEW PRODUCT"])
                    <div class="slick-carousel-wrapper-prod">
                        <div class="slick-carousel-prod">
                            <ul class="product-wn-list list-inline">
                                @foreach($products as $item)
                                <li>
                                    @include('Front/main_parts/product-item', [
                                        'id'=>$item->lang_id,
                                        'title'=>$item->title,
                                        'price'=>$item->price,
                                        'rate'=>$item->rate,
                                        'img'=>$item->files()->where('type','image')->first()
                                    ])
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop