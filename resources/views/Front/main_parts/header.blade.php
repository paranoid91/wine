<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Leri Bobokhidze"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @yield("meta")
    @yield("title")
    <link href="{{ asset("frontend/css/bootstrap.min.css") }}" rel="stylesheet">
    @yield("css")
    <link href="{{ asset("frontend/css/main.css") }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset("frontend/img/favicon.ico") }}" type="image/x-icon">
    @yield("header_script")
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield("description")
</head>
<body>
@yield("after-body")
<div id="page">
    <header>
        <div class="container-fluid header-top-wrapper">
            <div class="row no-margin">
                <div class="container">
                    <div class="row no-margin">
                        <div class="col-sm-3 col-md-3 col-lg-3 top-auth-links">
                            <p>Welcome <a href="{{ action('Frontend\CustomerController@regForm') }}">Register</a> or <a href="{{ action('Frontend\CustomerController@loginForm') }}">Login</a></p>
                        </div>
                        <div class="top-form-wr col-sm-9 col-md-9 col-lg-9">
                            <div class="header-top-form">
                                <div class="form-inline">
                                    <ul class="list-inline">
                                        <li>
                                            <div class="form-item-wr my-account">
                                                <div class="form-item-icon">
                                                    <span class="glyphicon glyphicon-user"></span>
                                                </div>
                                                <div class="form-item-desc">&nbsp;My Account</div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-item-wr flags-wrapper">
                                                <div class="form-item-icon">
                                                    {!! displayFlag() !!}
                                                </div>
                                                <div class="form-item-desc">
                                                    <select name="menu-lang" id="lang-menu">
                                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                        <option rel="alternate" hreflang="{{$localeCode}}" value="{{LaravelLocalization::getLocalizedURL($localeCode) }}"
                                                                @if(App::getLocale() == $localeCode) {{ 'selected class=active-lang' }} @endif>
                                                            {{ $properties['native'] }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="li-currency">
                                            <div class="form-item-wr currency-wrapper">
                                                <div class="form-item-icon">
                                                    <span class="glyphicon glyphicon-euro"></span>
                                                </div>
                                                <div class="form-item-desc">
                                                    <div class="form-item-desc">
                                                        <select class="form-control">
                                                            <option>GE Lari</option>
                                                            <option>US Dollar</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-item-wr search-wrapper">
                                                <div class="form-item-icon">

                                                </div>
                                                <div class="form-item-desc search-holder">
                                                    <input type="text" name="search" class="form-control" placeholder="Search..." />
                                                    <div class="search-icon-wr">
                                                        <span class="glyphicon glyphicon-search"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-navbar-wrapper">
            <div class="container no-padding">
                <div class="row no-margin">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid no-padding">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="{{ action("Frontend\PagesController@index") }}">
                                    <img src="{{ asset("frontend/img/main-logo.gif") }}" alt="logo" width="180" class="img-responsive"/>
                                </a>
                            </div>
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="{{ action("Frontend\PagesController@index") }}">HOME</a></li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle disabled" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">OUR WINES <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">ACCESORIES</a></li>
                                    <li><a href="#">BEST SALES</a></li>
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle disabled" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">STORY <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Another action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ action("Frontend\PagesController@aboutUs") }}">ABOUT US</a></li>
                                    <li><a href="{{ action("Frontend\PagesController@contact") }}">CONTACT</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>