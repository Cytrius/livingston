@extends('layouts.livingston')

@section('content')

<form class="lead-form" action="/quote" method="post">

<link href="{{ asset('css/form.css') }}" rel="stylesheet">

<style>

    .lead-gen-module {
        padding-top:60px;
    }

    .lg-section-holder:visible {
        border-bottom:none;   
    }

    .hidden { display:none; }
    .section-2 { display:none; }
    .section-2-2 { display:none; }
    .section-3 { display:none; }
    .section-3-2 { display:none; }

    .flatpickr-calendar, .lead-gen-form-container, .hidden, .section-2, .section-2-2, .section-3, .section-3-2 {
        -webkit-transition: none;
        -moz-transition: none;
        -ms-transition: none;
        -o-transition: none;
        transition: none;
    }

    .lead-gen-details {
        display:none;
    }
</style>

<script>

/* Lead Form Script */
$(document).ready(function() {

});

</script>

<div class="lead-gen-module-container lead-gen-main">
    <div class="lead-gen-module">
         <h2><span style="text-transform:uppercase;">{{ $user->name }},</span></h2>
                    <h2>Your Real-time Quote <span></span></h2>

    </div>
</div>

<div class="lead-gen-form-container lead-gen-main">
    <div class="lead-gen-form">
        <div id="lg-form-services">

            <div style="border:2px dashed #ccc; margin:1em; padding:1em;">

                <h4 style="color:#ccc;">For Testing Purposes</h4>
                <br/>

                <h3 style="color:#ccc;">Account</h3>
                @foreach($account->toArray() as $key=>$val)
                    <b>{{ $key }}:</b> {{ $val }}
                    <br/>
                @endforeach

                <br/>

                <h3 style="color:#ccc;">User</h3>
                @foreach($user->toArray() as $key=>$val)
                    <b>{{ $key }}:</b> {{ $val }}
                    <br/>
                @endforeach

                <br/>

                <h3 style="color:#ccc;">Form Values</h3>
                @foreach($form as $key=>$val)
                    <b>{{ $key }}:</b> {{ $val }}
                    <br/>
                @endforeach

            </div>

        </div>
    </div>
</div>

@endsection