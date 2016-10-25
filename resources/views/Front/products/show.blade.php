@extends("Front.app")

@section("title")<title>{{ $product->title }}</title>@stop

@section("css") <link rel="stylesheet" href="{{ asset('frontend/css/swiper.min.css') }}"> @stop

@section("content")
<div class="product-wrapper full-height ">
    <div class="container product-main-wr">
        <div class="row no-margin">
            <div class="col-md-5 col-lg-5">
            @if(count($product->files) > 0)
                <div class="swiper-container gallery-top">
                    <div class="swiper-wrapper">
                        {{ printSliderPics($product->files) }}
                    </div>
                    <div class="swiper-button-next swiper-button-white"></div>
                    <div class="swiper-button-prev swiper-button-white"></div>
                </div>
                <div class="swiper-container gallery-thumbs">
                    <div class="swiper-wrapper">
                        {{ printSliderPics($product->files) }}
                    </div>
                </div>
            @endif
            </div>
            <div class="col-md-7 col-lg-7">
                <div class="prod-desc-wrapper">
                    <div class="prod-headline">
                        <h2>{{ $product->title }}</h2>
                        <div class="prod-price-wr">
                            <div class="prod-price">{{ $product->price }}</div>
                            <div class="prod-tax">Ex Tax: {{ $product->extra_texas }}</div>
                        </div>
                        <div class="prod-rate">
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            &nbsp;&nbsp;
                            <p>0 Reviews / Write a review</p>
                        </div>
                    </div>
                    <div class="prod-tabs-wrapper">
                        <ul class="nav nav-tabs" role="tablist" id="myTabs">
                            <li role="presentation" class="active">
                                <a href="#description" aria-controls="home" role="tab" data-toggle="tab">Description</a>
                            </li>
                            @if(!empty($product->delivery))
                            <li role="presentation">
                                <a href="#delivery" aria-controls="profile" role="tab" data-toggle="tab">Delivery</a>
                            </li>
                            @endif
                            @if(!empty($product->serving_tips))
                            <li role="presentation">
                                <a href="#serving" aria-controls="messages" role="tab" data-toggle="tab">Serving Tips</a>
                            </li>
                            @endif
                        </ul>
                        <div class="tab-content prod-tabs">
                            <div role="tabpanel" class="tab-pane active" id="description">
                                {!! $product->description !!}
                            </div>
                            @if(!empty($product->delivery))
                            <div role="tabpanel" class="tab-pane fade" id="delivery">
                                {!! $product->delivery !!}
                            </div>
                            @endif
                            @if(!empty($product->serving_tips))
                            <div role="tabpanel" class="tab-pane fade" id="serving">
                                {!! $product->serving_tips !!}
                            </div>
                            @endif
                        </div>
                        <div class="prod-btn-wrap">
                            <a href="#" class="prod-btn">Add to Cart</a>
                            <div class="prod-count">1</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section("script")
<script src="{{ asset('frontend/js/swiper.min.js') }}"></script>
<script>
    var galleryTop = new Swiper('.gallery-top', {
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        spaceBetween: 10

    });
    var galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 10,
        centeredSlides: true,
        slidesPerView: 'auto',
        touchRatio: 0.2,
        slideToClickedSlide: true
    });
    galleryTop.params.control = galleryThumbs;
    galleryThumbs.params.control = galleryTop;
</script>
@stop