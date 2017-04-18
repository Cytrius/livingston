<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sonas</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,500,600" rel="stylesheet" type="text/css">

        <script src="https://use.fontawesome.com/19c0709409.js"></script>

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

            .intro {
                width:1200px;
                margin:0 auto;
                min-height:600px;
                z-index: 2;
                position: relative;
            }

            .intro h1 {
                color:#fff;
                font-size: 3.35em;
                font-weight: 500;
                position: absolute;
                top: 11%;
            }

            .intro img {
                max-width: 640px;
                border-radius: 8px;
                box-shadow: 0px 0px 20px #8a8a8a;
                float: right;
                position: relative;
                top: 15em;
                right: 2em;
            }

            .intro .bar {
                height:6px;
                width: 400px;
                position: relative;
                top: 25em;
                right: -15%;
                /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#9d8bcc+0,b9e1db+100 */
                background: rgb(157,139,204); /* Old browsers */
                background: -moz-linear-gradient(left, rgba(157,139,204,1) 0%, rgba(185,225,219,1) 100%); /* FF3.6-15 */
                background: -webkit-linear-gradient(left, rgba(157,139,204,1) 0%,rgba(185,225,219,1) 100%); /* Chrome10-25,Safari5.1-6 */
                background: linear-gradient(to right, rgba(157,139,204,1) 0%,rgba(185,225,219,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#9d8bcc', endColorstr='#b9e1db',GradientType=1 ); /* IE6-9 */
            }

            .intro .circle {
                width:70px;
                height:70px;
                border-radius:35px;
                background-color:#9d8bcc;
                position: relative;
                top: 24.6em;
                right: -15%;
                transform: translate(-50%, -50%);
                text-align:center;
                line-height:70px;
            }

            .intro .circle i {
                color: #fff;
                font-size: 32px;
                position: relative;
                top: 6px; z-index:2;
            }

            .intro .circle2 {
                width: 120px;
                height: 120px;
                border-radius: 60px;
                background-color: #9d8bcc;
                position: absolute;
                top: 0;
                right: 0;
                transform: translate(21%, -21%);
                opacity: 0.3;
            }


            .intro .circle3 {
                width: 160px;
                height: 160px;
                border-radius: 80px;
                background-color: #9d8bcc;
                position: absolute;
                top: 0;
                right: 0;
                transform: translate(28%, -28%);
                opacity: 0.2;
            }


            .intro .circle4 {
                width: 200px;
                height: 200px;
                border-radius: 100px;
                background-color: #9d8bcc;
                position: absolute;
                top: 0;
                right: 0;
                transform: translate(32%, -32%);
                opacity: 0.1;
            }

            .ocean { 
                height: 5%;
                width: 100%;
                position: relative;
                left: 0;
                top: 4.5em;
                z-index: 0;
            }

            .wave {
              background: url(/images/wave2.svg) repeat-x; 
              position: absolute;
              top: -221px;
              width: 500%;
              height: 198px;
              animation: wave 14s cubic-bezier( 0.36, 0.45, 0.63, 0.53) infinite, swell 8s ease -3s infinite;
              transform: translate3d(0, 0, 0);
            }

            .wave.wave-top {
                background: url(/images/wave.svg) repeat-x; 
                opacity:0.5;
              top: -245px;
              left:-20%;
              animation: wave 14s cubic-bezier( 0.36, 0.45, 0.63, 0.53) -.125s infinite, swell 8s ease -3s infinite;
            }

            @keyframes wave {
              0% {
                margin-left: 0;
              }
              100% {
                margin-left: -1600px;
              }
            }

            @keyframes swell {
              0%, 100% {
                transform: translate3d(0,-25px,0);
              }
              50% {
                transform: translate3d(0,5px,0);
              }
            }  

            .features {
                margin-top:15em;
            }
            .feature-column {
                float:left;
                width:33%;
                text-align:center;
            }
            .feature-column h2 {
                font-weight: 400;
                font-size: 33px;
                text-transform: uppercase;
            }
            .feature-column p {
                font-size: 20px;
                font-weight: 100;
                line-height: 30px;
            }

            .cta {
                width:1100px;
                margin:0 auto;
                clear: both;
                padding-top: 10em;
            }

            .cta h1 {
                color:#333;
                font-size: 3.35em;
                font-weight: 500;
                float:left;
            }

            .cta a {
                margin-top: 8%;
                background: rgb(52,215,180);
                background: -moz-linear-gradient(left, rgba(52,215,180,1) 0%, rgba(157,139,204,1) 100%);
                background: -webkit-linear-gradient(left, rgba(52,215,180,1) 0%,rgba(157,139,204,1) 100%);
                background: linear-gradient(to right, rgba(52,215,180,1) 0%,rgba(157,139,204,1) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#34d7b4', endColorstr='#9d8bcc',GradientType=1 );
                font-size: 25px;
                color: #fff;
                border-radius: 32px;
                padding: 0.5em 1.57em;
                font-weight: 400;
                float: right;
            }

            .video {
                clear: both;
                text-align: center;
                padding-top: 10em;
            }

            .video-thumbnail {
                padding-top:4em;
            }

            .pricing h1 {
                color:#333;
                font-size: 3.35em;
                font-weight: 500;
                float:left;
            }

            .pricing {
                text-align:center;
                padding-top:5em;
            }
            .pricing h1 {
                width:100%;
                text-align:center;
            }

            .pricing h1 span {
                color:#9f89c8;
            }

            .pricing img {
                padding-top:5em;
            }

            .footer {
                min-height:400px;
                width:100%;
/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#9d8bcc+0,34d7b4+100 */
background: rgb(157,139,204); /* Old browsers */
background: -moz-linear-gradient(left, rgba(157,139,204,1) 0%, rgba(52,215,180,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(left, rgba(157,139,204,1) 0%,rgba(52,215,180,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to right, rgba(157,139,204,1) 0%,rgba(52,215,180,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#9d8bcc', endColorstr='#34d7b4',GradientType=1 ); /* IE6-9 */
            }

        </style>
    </head>
    <body>
        <div class="nav">
            <a href="#">Pricing</a>
            <a href="#">Product</a>
            <a href="#">Company</a>
        </div>
        <div class="masthead">
            <div class="header">
                <img src="/images/logo_white.png">
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
            <div class="intro">
                <h1>A simple tool for sales to easily keep track of buyer<br/>personas.</h1>
                <div class="bar"></div>
                <div class="circle">
                    <i class="fa fa-user-circle-o"></i>
                    <div class="circle2"></div>
                    <div class="circle3"></div>
                    <div class="circle4"></div>
                </div>
                <img src="images/screenshot.png">
            </div>
            <div class="ocean">
                <div class="wave wave-bottom"></div>
                <div class="wave wave-top"></div>
            </div>
        </div>
        <div class="features">
            <div class="feature-column">
                <img src="images/feat1.png">
                <h2>Capture</h2>
                <p>Easily capture Linkedin profiles<br/>with the easy to use chrome<br/>extension, or start from scratch</p>
            </div>
            <div class="feature-column">
                <img src="images/feat2.png">
                <h2>Catalogue</h2>
                <p>Create a database of personas with<br/>detailed buyer signals, industry<br/>keywords and skills</p>
            </div>
            <div class="feature-column">
                <img src="images/feat3.png">
                <h2>Search</h2>
                <p>Allow you and your team to<br/>quickly search through personas to<br/>prepare for potential customers</p>
            </div>
        </div>
        <div class="cta">
            <h1>Understanding your potential<br/>customers has never been so simple.</h1>
            <a class="/register">Sign Up</a>
        </div>
        <div class="video">
            <img src="images/seeit.png">
            <img class="video-thumbnail" src="images/video.png">
        </div>
        <div class="pricing">
            <h1>Simple product, simple <span>pricing</span>.</h1>
            <img src="images/pricing.png">
        </div>
        <div class="signup"></div>
        <div class="footer"></div>
    </body>
</html>
