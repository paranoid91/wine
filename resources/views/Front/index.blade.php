@extends("Front/app")

@section("title")
<title>Home</title>
@stop

@section("content")
<div id="content">
    <div class="main-slider">
        @if(count($slider) > 0)
            @include('Front/main_parts/main-slider', ['slider' => $slider])
        @endif
        <div class="main-products-wrapper">
            <div class="offers-slogans-wr">
                <div class="offers-sl-w">
                    <div class="offers-slogan-bg">
                        <img src="{{ asset('img/green-bg.gif') }}" alt="slogan-bg" class="img-responsive">
                    </div>
                    <div class="row no-margin">
                        <div class="offs-txt col-sm-4 col-md-4 col-lg-4">
                            <div class="row no-margin offs-wr-lf">
                                <div class="offs-txt-l col-sm-3 col-md-3 col-lg-3">
                                    <img src="{{ asset('img/free-shipping.png') }}" alt="free-shipping" width="65" />
                                </div>
                                <div class="offs-txt-r col-sm-9 col-md-9 col-lg-9">
                                    <h3>FREE SHIPPING</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</p>
                                </div>
                            </div>
                        </div>
                        <div class="offs-txt col-sm-4 col-md-4 col-lg-4">
                            <div class="row no-margin offs-wr-cn">
                                <div class="offs-txt-l col-sm-3 col-md-3 col-lg-3">
                                    <img src="{{ asset('img/wineondesk.png') }}" class="win-desc-img" width="50" />
                                </div>
                                <div class="offs-txt-r col-md-9 col-lg-9">
                                    <h3 class="offs-txt-midl-headl">ANNIVERSARY WINES</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</p>
                                </div>
                            </div>
                        </div>
                        <div class="offs-txt col-sm-4 col-md-4 col-lg-4">
                            <div class="row no-margin offs-wr-rg">
                                <div class="offs-txt-l offs-txt-l-last col-sm-offset-1 col-sm-2 col-md-offset-1 col-md-2 col-lg-offset-1 col-lg-2">
                                    <img src="{{ asset('img/wine-bugs.png') }}" class="img-wine-bgs" height="45" />
                                </div>
                                <div class="offs-txt-r col-sm-9 col-md-9 col-lg-9">
                                    <h3>SALE AND SPECIAL</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($new_products)>0)
            <div class="container">
                <div class="row no-margin">
                    @include("Front/main_parts/slick-control", ["title"=>"NEW PRODUCT"])
                    <div class="slick-carousel-wrapper">
                        <div class="slick-carousel">
                            @foreach($new_products as $item)
                                @include('Front/main_parts/product-item', [
                                    'id'=>$item->id,
                                    'title'=>$item->title,
                                    'price'=>$item->price,
                                    'rate'=>$item->rate,
                                    'img'=>$item->files()->where('type','image')->first()->name
                                ])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="container-fluid collect-wrapper no-padding">
            <div class="container collect-wr">
                <h1 class="text-center">The Collection</h1>
                <div class="row no-margin">
                    <div class="col-sm-4 col-md-4 col-lg-4 collect-desc">
                        <h3>About Wine</h3>
                        <hr/>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <div class="text-right">
                            <a href="#">Read More...</a>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 collect-desc">
                        <h3>About Wine</h3>
                        <hr/>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <div class="text-right">
                            <a href="#">Read More...</a>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 collect-desc">
                        <h3>About Wine</h3>
                        <hr/>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <div class="text-right">
                            <a href="#">Read More...</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="container-fluid store-wrapper">
            <div class="container no-padding">
                <h1 class="text-center">Welcome to Wine Store</h1>
                <div class="row no-margin">
                    <div class="col-sm-2 col-md-2 col-lg-2 img-bottle-left">
                        <img src="{{ asset('img/winebottles.png') }}" class="img-responsive"/>
                    </div>
                    <div class="col-sm-8 col-md-8 col-lg-8 wel-store-text">
                        <p class="text-center">Moet & Chandon Imperial – Created from more than 100 different wines, of which 20% to 30% are reserve wines specially selected to enhance its maturity, complexityits maturity, complexity and constancy, the assemblage reflects the diversity and complementarity of the three grapes varietals.</p>
                        <p class="text-center">Moet & Chandon Imperial – Created from more than 100 different wines, of which 20% to 30% are reserve wines specially selected to enhance its maturity, complexityits maturity, complexity and constancy, the assemblage reflects the diversity and complementarity of the three grapes varietals.</p>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2 img-bottle-right">
                        <img src="{{ asset('img/bce6t4ggv.png') }}" class="img-responsive"/>
                    </div>
                </div>
            </div>
        </div>
        @if(count($news)>0)
        <div class="container-fluid stories-wrapper">
            <div class="container no-padding">
                @include("Front/main_parts/slick-control", ["title"=>"STORYES"])
                <div class="slick-carousel-wrapper slick-storyes-wr">
                    <div class="slick-carousel-storyes">
                        @for($i=0, $j=0; $i<count($news); $i++, $j++)

                            @if($j==4) <?php $j=0; ?> @endif

                            @if($j==0)
                            <div class="row storyes-row">
                                <div class="slick-content">
                            @endif

                            @include('Front/main_parts/slick-stories', [
                                    'id' => $news[$i]->id,
                                    'title' => $news[$i]->title,
                                    'desc' => $news[$i]->desc,
                                    'img' => (null !== ($news[$i]->files()->where("type", "image")->first())) ? $news[$i]->files()->where('type','image')->first()->name : null,
                                    'reverse' => ($j>1) ? true : false
                            ])

                            @if($j==3 || $i == (count($news) - 1))
                                </div>
                            </div>
                            @endif

                        @endfor
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="container-fluid gallery-main-wrapper">
            <div class="container no-padding">
                @include("Front/main_parts/slick-control", ["title"=>"GALLERY"])
                <div class="slick-carousel-wrapper">
                    <div class="slick-carousel-gallery">
                        <div class="row storyes-row">
                            <div class="slick-content">
                                <div class="row no-margin">
                                    <div class="col-md-6 col-lg-6 galler-texts">
                                        <h3>Geogia and vine</h3>
                                        <p>Moet & Chandon Imperial – Created from more than 100 different wines, of which selected to enhance its maturtyits maturity, complexity and constancy, the assemblage reflects the complementarity of the three grapes varietals.</p>
                                        <p>Moet & Chandon Imperial – Created from more than 100 different wines, of which 20% to 30% are reserve wines specially selected to enhance its maturity, complexityits reflects the diversity and </p>
                                        <p>Moet & Chandon Imperial – Created from more than 100 different wines, of which 20% to 30% are reserve wines specially selected to enhance its maturity, complexityits reflects the diversity and </p>
                                        <p>Moet & Chandon Imperial – Created from more than 100 different wines, of which 20% to 30% are reserve wines specially selected to enhance its maturity, complexityits reflects the diversity and </p>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="row no-margin galler-img-icons">
                                            <div class="col-xs-5 col-sm-4 col-md-4 col-md-4 col-lg-4 gal-img-wr no-padding">
                                                <div style="background-image: url('http://st18.stpulscen.ru/images/product/083/359/744_medium.jpg')"></div>
                                            </div>
                                            <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 gal-img-wr no-padding">
                                                <div style="background-image: url('http://thecavendisharms.co.uk/wp-content/uploads/2015/02/red-wine-barrel-200x200.jpg')"></div>
                                            </div>
                                            <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 gal-img-wr no-padding">
                                                <div style="background-image: url('https://pull01-kegworks.netdna-ssl.com/media/catalog/product/cache/1/small_image/200x/9df78eab33525d08d6e5fb8d27136e95/1/7/177512-footed-port-wine-sipper-b2_1.jpg')"></div>
                                            </div>
                                            <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 gal-img-wr no-padding">
                                                <div style="background-image: url('http://images.ru.prom.st/162151462_w200_h200_vinograd_alfa.jpg')"></div>
                                            </div>
                                            <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 gal-img-wr no-padding">
                                                <div style="background-image: url('http://wineharlots.com/wp-content/uploads/2015/04/Talbott-Vineyards-Pickup-Party-2015-151.jpg')"></div>
                                            </div>
                                            <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 gal-img-wr no-padding">
                                                <div style="background-image: url('http://s019.radikal.ru/i624/1309/12/b671b3047582.jpg')"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row storyes-row">
                            <div class="slick-content">
                                <div class="row no-margin">
                                    <div class="col-md-6 col-lg-6 galler-texts">
                                        <h3>Geogia and vine</h3>
                                        <p>Moet & Chandon Imperial – Created from more than 100 different wines, of which selected to enhance its maturtyits maturity, complexity and constancy, the assemblage reflects the complementarity of the three grapes varietals.</p>
                                        <p>Moet & Chandon Imperial – Created from more than 100 different wines, of which 20% to 30% are reserve wines specially selected to enhance its maturity, complexityits reflects the diversity and </p>
                                        <p>Moet & Chandon Imperial – Created from more than 100 different wines, of which 20% to 30% are reserve wines specially selected to enhance its maturity, complexityits reflects the diversity and </p>
                                        <p>Moet & Chandon Imperial – Created from more than 100 different wines, of which 20% to 30% are reserve wines specially selected to enhance its maturity, complexityits reflects the diversity and </p>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="row no-margin galler-img-icons">
                                            <div class="col-xs-5 col-sm-4 col-md-4 col-md-4 col-lg-4 gal-img-wr no-padding">
                                                <div style="background-image: url('http://st18.stpulscen.ru/images/product/083/359/744_medium.jpg')"></div>
                                            </div>
                                            <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 gal-img-wr no-padding">
                                                <div style="background-image: url('http://thecavendisharms.co.uk/wp-content/uploads/2015/02/red-wine-barrel-200x200.jpg')"></div>
                                            </div>
                                            <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 gal-img-wr no-padding">
                                                <div style="background-image: url('https://pull01-kegworks.netdna-ssl.com/media/catalog/product/cache/1/small_image/200x/9df78eab33525d08d6e5fb8d27136e95/1/7/177512-footed-port-wine-sipper-b2_1.jpg')"></div>
                                            </div>
                                            <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 gal-img-wr no-padding">
                                                <div style="background-image: url('http://images.ru.prom.st/162151462_w200_h200_vinograd_alfa.jpg')"></div>
                                            </div>
                                            <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 gal-img-wr no-padding">
                                                <div style="background-image: url('http://wineharlots.com/wp-content/uploads/2015/04/Talbott-Vineyards-Pickup-Party-2015-151.jpg')"></div>
                                            </div>
                                            <div class="col-xs-5 col-sm-4 col-md-4 col-lg-4 gal-img-wr no-padding">
                                                <div style="background-image: url('http://s019.radikal.ru/i624/1309/12/b671b3047582.jpg')"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(isset($accessors) and count($accessors)>0)
        <div class="container-fluid acess-wrap">
            <div class="container no-padding">
                <div class="row no-margin">
                    @include("Front/main_parts/slick-control", ["title"=>"ACCESSORIES"])
                    <div class="slick-carousel-wrapper">
                        <div class="slick-carousel">
                            @include('Front/main_parts/product-item', [
                                'id'=>$item->id,
                                'title'=>$item->title,
                                'price'=>$item->price,
                                'rate'=>$item->rate,
                                'img'=>$item->files()->where('type','image')->first()->name
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        {{--<div class="shp-wine-cont">
            <div class="container">
                <div class="row shp-wine">
                    @include('Front/main_parts/prod-desc-bottom')
                    @include('Front/main_parts/prod-desc-bottom')
                </div>
            </div>
        </div>--}}
    </div>
</div>
@endsection

@section("script")
<script type="text/javascript" src="{{ asset("frontend/js/slick.min.js") }}"></script>
@stop