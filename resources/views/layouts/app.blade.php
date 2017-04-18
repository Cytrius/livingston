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

    <script src="https://use.fontawesome.com/1c93c020aa.js"></script>

    <base href="/">

    <style>
        body, html {
            background:#fafafa!important;
            font-family: 'Roboto', sans-serif;
            overflow:hidden;
            height:100%;
        }

        #app {
            height:100%;
        }
        app {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height:100%;
            overflow:hidden;
        }
        .ui.small.modal {
          bottom:auto !important;
        }
        .ui.dimmer.modals {
          z-index:9999999;
          
        }
        .ui.static.segments.edit .ui.multiple.dropdown>.label {
          font-size: .78571429rem !important;
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
    <div id="app">

    @if(false === true)
        @if (Auth::guest())
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        @endif
    @endif

        @yield('content')
    </div>

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
