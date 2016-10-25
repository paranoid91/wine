<div class="col-sm-6 col-md-6 col-lg-6 str-img-wr">
    @if($reverse == true)
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 storyes-texts">
            <h3>{{ $title }}</h3>
            <p>{{ $desc }}</p>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 str-mn-wr">
            <a href="{{ action("Frontend\FrontNewsController@show", ["id" => $id]) }}" style="display: block">
                <div class="storyes-img" style="background-image: url({{ asset($img) }})"></div>
            </a>
        </div>
    @else
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 str-mn-wr">
            <a href="{{ action("Frontend\FrontNewsController@show", ["id" => $id]) }}" style="display: block">
                <div class="storyes-img" style="background-image: url({{ asset($img) }})"></div>
            </a>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 storyes-texts">
            <h3>{{ $title }}</h3>
            <p>{{ $desc }}</p>
        </div>
    @endif
</div>