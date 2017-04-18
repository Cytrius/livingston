<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script
      src="https://code.jquery.com/jquery-3.2.0.min.js"
      integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I="
      crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="/semantic/semantic.min.css" rel="stylesheet">

      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Raleway:100,500,600" rel="stylesheet" type="text/css">

      <script src="https://use.fontawesome.com/19c0709409.js"></script>



    <base href="/">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 400;
                font-size:14px;
                height: 100vh;
                margin: 0;
                overflow-x:hidden;
            }

            body {
              overflow-y:scroll;
            }

            .masthead {
                /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#34d7b4+0,9d8bcc+100 */
                background: rgb(52,215,180); /* Old browsers */
                background: -moz-linear-gradient(left, rgba(52,215,180,1) 0%, rgba(157,139,204,1) 100%); /* FF3.6-15 */
                background: -webkit-linear-gradient(left, rgba(52,215,180,1) 0%,rgba(157,139,204,1) 100%); /* Chrome10-25,Safari5.1-6 */
                background: linear-gradient(to right, rgba(52,215,180,1) 0%,rgba(157,139,204,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#34d7b4', endColorstr='#9d8bcc',GradientType=1 ); /* IE6-9 */
            }

            .header {
                height:86px;
                border-bottom:1px solid #ccc;
            }

            .header img {
                margin-top: 14px;
                padding-left:30px;
            }

            .header .top-right {
                float:right;
                height:86px;
                line-height:86px;
                padding-right:30px;
            }

            .header .top-right a {
                display:inline;
                background:#fff;
                color:#000;
                border-radius:20px;
                text-decoration:none;
                padding:10px;
                font-weight: 500;
            }

            .header .top-right a.basic {
                background:none;
                color:#fff;
            }

            .panel-heading {
              border:none;
            }

            .panel {
              border:none;
              box-shadow:none;
            }

            .nav {
                text-align:center;
                width: 500px;
                margin: 0 auto;
                position: relative;
                top: 33px;
                margin-bottom: -21px;
            }

            .nav a {
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                font-size:14px;
                height: 100vh;
                color:#fff;
                font-size:18px;
                text-decoration:none;
                padding:0 1em;
            }

            button.btn.btn-primary {
              background: rgb(52,215,180);
    border:none;
            }
    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
        <div class="nav">
            <a href="#">Pricing</a>
            <a href="#">Product</a>
            <a href="#">Company</a>
        </div>
        <div class="masthead">
            <div class="header">
                <a href="/"><img src="/images/logo_white.png"></a>
                @if (Route::has('login'))
                    <div class="top-right links">
                        @if (Auth::check())
                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                        @else
                            <a href="{{ url('/register') }}">Sign Up</a>
                            &nbsp;
                            <a class="basic" href="{{ url('/login') }}">Log In</a> 
                        @endif
                    </div>
                @endif
            </div>
        </div>

        @yield('content')
 

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        var User = User || {};

        <?php 
            /**
             * User Information
             */
            if (Auth::check()) {
                $user = Auth::user();
                echo 'User = '.json_encode($user->toArray()).';';
            } 
        ?>
    </script>

    <!-- Semantic UI -->
    <script src="/semantic/semantic.min.js"></script>
  
    <!-- JQuery Sortable CDN -->
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

    <!-- Load Application Polyfills (Old Browsers) -->
    @if(isset($assets['polyfill']))
        <script src="/dist/{{ $assets['polyfill'] }}"></script>
    @endif

    <!-- Load Vendor Files (Angular) -->
    @if(isset($assets['vendor']))
        <script src="/dist/{{ $assets['vendor'] }}"></script>
    @endif

    <!-- Load Application -->
    @if(isset($assets['app']))
        <script src="/dist/{{ $assets['app'] }}"></script>
    @endif

        <style>
        /**
 * Owl Carousel v2.2.1
 * Copyright 2013-2017 David Deutsch
 * Licensed under  ()
 */
/*
 *  Owl Carousel - Core
 */
.owl-carousel {
  display: none;
  width: 100%;
  -webkit-tap-highlight-color: transparent;
  /* position relative and z-index fix webkit rendering fonts issue */
  position: relative;
  z-index: 1; }
  .owl-carousel .owl-stage {
    position: relative;
    -ms-touch-action: pan-Y;
    -moz-backface-visibility: hidden;
    /* fix firefox animation glitch */ }
  .owl-carousel .owl-stage:after {
    content: ".";
    display: block;
    clear: both;
    visibility: hidden;
    line-height: 0;
    height: 0; }
  .owl-carousel .owl-stage-outer {
    position: relative;
    overflow: hidden;
    /* fix for flashing background */
    -webkit-transform: translate3d(0px, 0px, 0px); }
  .owl-carousel .owl-wrapper,
  .owl-carousel .owl-item {
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    -webkit-transform: translate3d(0, 0, 0);
    -moz-transform: translate3d(0, 0, 0);
    -ms-transform: translate3d(0, 0, 0); }
  .owl-carousel .owl-item {
    position: relative;
    min-height: 1px;
    float: left;
    -webkit-backface-visibility: hidden;
    -webkit-tap-highlight-color: transparent;
    -webkit-touch-callout: none; }
  .owl-carousel .owl-item img {
    display: block;
    width: 100%; }
  .owl-carousel .owl-nav.disabled,
  .owl-carousel .owl-dots.disabled {
    display: none; }
  .owl-carousel .owl-nav .owl-prev,
  .owl-carousel .owl-nav .owl-next,
  .owl-carousel .owl-dot {
    cursor: pointer;
    cursor: hand;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none; }
  .owl-carousel.owl-loaded {
    display: block; }
  .owl-carousel.owl-loading {
    opacity: 0;
    display: block; }
  .owl-carousel.owl-hidden {
    opacity: 0; }
  .owl-carousel.owl-refresh .owl-item {
    visibility: hidden; }
  .owl-carousel.owl-drag .owl-item {
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none; }
  .owl-carousel.owl-grab {
    cursor: move;
    cursor: grab; }
  .owl-carousel.owl-rtl {
    direction: rtl; }
  .owl-carousel.owl-rtl .owl-item {
    float: right; }

/* No Js */
.no-js .owl-carousel {
  display: block; }

/*
 *  Owl Carousel - Animate Plugin
 */
.owl-carousel .animated {
  animation-duration: 1000ms;
  animation-fill-mode: both; }

.owl-carousel .owl-animated-in {
  z-index: 0; }

.owl-carousel .owl-animated-out {
  z-index: 1; }

.owl-carousel .fadeOut {
  animation-name: fadeOut; }

@keyframes fadeOut {
  0% {
    opacity: 1; }
  100% {
    opacity: 0; } }

/*
 *  Owl Carousel - Auto Height Plugin
 */
.owl-height {
  transition: height 500ms ease-in-out; }

/*
 *  Owl Carousel - Lazy Load Plugin
 */
.owl-carousel .owl-item .owl-lazy {
  opacity: 0;
  transition: opacity 400ms ease; }

.owl-carousel .owl-item img.owl-lazy {
  transform-style: preserve-3d; }

/*
 *  Owl Carousel - Video Plugin
 */
.owl-carousel .owl-video-wrapper {
  position: relative;
  height: 100%;
  background: #000; }

.owl-carousel .owl-video-play-icon {
  position: absolute;
  height: 80px;
  width: 80px;
  left: 50%;
  top: 50%;
  margin-left: -40px;
  margin-top: -40px;
  background: url("owl.video.play.png") no-repeat;
  cursor: pointer;
  z-index: 1;
  -webkit-backface-visibility: hidden;
  transition: transform 100ms ease; }

.owl-carousel .owl-video-play-icon:hover {
  -ms-transform: scale(1.3, 1.3);
      transform: scale(1.3, 1.3); }

.owl-carousel .owl-video-playing .owl-video-tn,
.owl-carousel .owl-video-playing .owl-video-play-icon {
  display: none; }

.owl-carousel .owl-video-tn {
  opacity: 0;
  height: 100%;
  background-position: center center;
  background-repeat: no-repeat;
  background-size: contain;
  transition: opacity 400ms ease; }

.owl-carousel .owl-video-frame {
  position: relative;
  z-index: 1;
  height: 100%;
  width: 100%; }

        </style>
</body>
</html>
