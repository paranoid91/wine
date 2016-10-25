<div class="slick-content">
    <div class="slick-product-item">
        <a href="{{ action('Frontend\FrontProductController@show', ['id' => $id]) }}">
            <div class="product-item-img-wr">
                <div class="product-item-img" style="background-image: url({{$img}})"></div>
            </div>
        </a>
        <div class="product-item-desc">
            <div class="prod-item-top">
                <h1>{{$title}}</h1>
                <div>
                    <img src="{{ asset('img/rate-bottle.png') }}" width="100" alt="{{$title}}"/>
                    <span>0 Review(s)</span>
                </div>
                <hr/>
            </div>
            <div class="prod-item-bot">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 itm-price">{{$price}}</div>
                    <div class="col-sm-6 col-md-6 col-lg-6 add-cart-bt">
                        <a href="#">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>