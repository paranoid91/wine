@extends("Front.app")

@section('meta')
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $news->title }}" />
    <meta property="og:site_name" content="{{ $_SERVER['HTTP_HOST'] }}">
    <meta property="og:description" content="{{ $news->description }}" />
    <meta property="og:image" content="{{ asset($news->image) }}">
@stop

@section("title")
<title>{{ $news->title }}</title>
@stop

@section("css")
<style type="text/css">
    body:after{content:url({{ asset('images/close.png') }}) url({{ asset('images/loading.gif') }}) url({{ asset('images/prev.png') }}) url({{ asset('images/next.png') }});display:none}body.lb-disable-scrolling{overflow:hidden}.lightboxOverlay{position:absolute;top:0;left:0;z-index:9999;background-color:#000;filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=80);opacity:.8;display:none}.lightbox{position:absolute;left:0;width:100%;z-index:10000;text-align:center;line-height:0;font-weight:400}.lightbox .lb-image{display:block;height:auto;max-width:inherit;border-radius:3px}.lightbox a img{border:none}.lb-outerContainer{position:relative;background-color:#fff;*zoom:1;width:250px;height:250px;margin:0 auto;border-radius:4px}.lb-outerContainer:after{content:"";display:table;clear:both}.lb-container{padding:4px}.lb-loader{position:absolute;top:43%;left:0;height:25%;width:100%;text-align:center;line-height:0}.lb-cancel{display:block;width:32px;height:32px;margin:0 auto;background:url({{ asset('images/loading.gif') }}) no-repeat}.lb-nav{position:absolute;top:0;left:0;height:100%;width:100%;z-index:10}.lb-container > .nav{left:0}.lb-nav a{outline:none;background-image:url(data:image/gif;base64,R0lGODlhAQABAPAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==)}.lb-prev,.lb-next{height:100%;cursor:pointer;display:block}.lb-nav a.lb-prev{width:34%;left:0;float:left;background:url({{ asset('images/prev.png') }}) left 48% no-repeat;filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=0);opacity:0;-webkit-transition:opacity .6s;-moz-transition:opacity .6s;-o-transition:opacity .6s;transition:opacity .6s}.lb-nav a.lb-prev:hover{filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=100);opacity:1}.lb-nav a.lb-next{width:64%;right:0;float:right;background:url({{ asset('images/next.png') }}) right 48% no-repeat;filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=0);opacity:0;-webkit-transition:opacity .6s;-moz-transition:opacity .6s;-o-transition:opacity .6s;transition:opacity .6s}.lb-nav a.lb-next:hover{filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=100);opacity:1}.lb-dataContainer{margin:0 auto;padding-top:5px;*zoom:1;width:100%;-moz-border-radius-bottomleft:4px;-webkit-border-bottom-left-radius:4px;border-bottom-left-radius:4px;-moz-border-radius-bottomright:4px;-webkit-border-bottom-right-radius:4px;border-bottom-right-radius:4px}.lb-dataContainer:after{content:"";display:table;clear:both}.lb-data{padding:0 4px;color:#ccc}.lb-data .lb-details{width:85%;float:left;text-align:left;line-height:1.1em}.lb-data .lb-caption{font-size:13px;font-weight:700;line-height:1em}.lb-data .lb-number{display:block;clear:left;padding-bottom:1em;font-size:12px;color:#999}.lb-data .lb-close{display:block;float:right;width:30px;height:30px;background:url({{ asset('images/close.png') }}) top right no-repeat;text-align:right;outline:none;filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=70);opacity:.7;-webkit-transition:opacity .2s;-moz-transition:opacity .2s;-o-transition:opacity .2s;transition:opacity .2s}.lb-data .lb-close:hover{cursor:pointer;filter:progid:DXImageTransform.Microsoft.Alpha(Opacity=100);opacity:1}
</style>
@stop

@section("after-body")
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7&appId=817437348387440";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
@stop

@section("content")
<div class="content-news-show">
    <div class="container news-show-container">
        <div class="row">
            <div class="col-md-6 col-lg-6 news-show-headl">
                <h1>{{ $news->title }}</h1>
            </div>
            <div class="col-md-6 col-lg-6 news-show-soc">
                <div class="fb-like" data-href="" data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="false"></div>
            </div>
        </div>
        <div class="news-show-text">
            {!! $news->text !!}
        </div>
        @if(count($news->files) > 0)
            <div class="news-show-slider lbox-slider">
            @foreach($news->files as $image)
               <a href="{{ asset($image->name) }}" data-lightbox="{{ $image->name }}" data-title="{{ $image->name }}">
                   <div style="background-image: url({{ asset($image->name) }})"></div>
               </a>
            @endforeach
            </div>
        @endif
        <div class="news-show-comment">
            <div class="fb-comments" data-href="{{ Request::url() }}" data-width="100%" data-numposts="5"></div>
        </div>
    </div>
</div>
@stop

@section("script")
<script src="{{ asset('frontend/js/lightbox.js') }}"></script>
@stop