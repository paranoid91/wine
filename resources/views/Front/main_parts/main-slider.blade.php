<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        @for($i = 1; $i < count($slider); $i++)
            <li data-target="#myCarousel" data-slide-to="{{ $i }}"></li>
        @endfor
    </ol>
    <div class="carousel-inner" role="listbox">
        @for($i = 0; $i < count($slider); $i++)
            <div class="item @if($i==0) {{ 'active' }} @endif">
                <img src="{{ asset($slider[$i]->poster) }}" alt="{{ $slider[$i]->title }}">
                <div class="slider-main-txt">
                    <div class="transp-text">
                        <!-- <p>-GEORGIAN-</p> -->
                    </div>
                    <div class="main-slider-headline">
                        <h1>{{ $slider[$i]->title }}</h1>
                    </div>
                    <div class="slider-desc-txt">
                        {{--<p class="text-center">ONLY NATURALE WINE<br/><span>SIENCE 2013</span></p>--}}
                        <p class="text-center">{{ $slider[$i]->sub_title }}</p>
                    </div>
                    <div class="main-slider-button">
                        <a href="{{ $slider[$i]->link }}">OPEN SHOP</a>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>