@include('admin.inc.header')
<div class="{{(isset($_COOKIE['nav_bar']) != false) ? 'topSide' : 'leftSide'}} "><!--class="leftSide"-->
  @if(!Auth::guest())
    @include('admin.inc.menu')
  @endif
</div>
<div class="{{(strpos(Route::getCurrentRoute()->uri(),'auth')) ? 'centerSide' : ((isset($_COOKIE['nav_bar']) != false) ? 'middleSide':'rightSide')}}">
  <div id="alert-messages">@include('flash::message')</div>
  @yield('content')
</div>
<div id="rightSideData" data-preloader="{{asset('admin/images/main/loader.gif')}}">
 <div class="ajax-content"></div>
</div>
@include('admin.inc.footer')