@if(Auth::check())
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                {{--<ul class="nav navbar-nav">--}}
                    {{--<li><a href="{{ url('/') }}">{{trans('admin.visit_website')}}</a></li>--}}
                {{--</ul>--}}
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ action('Admin\Auth\AuthController@logout') }}">{{trans('admin.logout')}}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endif