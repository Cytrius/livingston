@extends('layouts.livingston')

@section('content')

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

    .lead-gen-button.grey {
        background-color:#bcc5ce !important;
    }

    .lead-gen-details {
        display:none;
    }

    div.quote {
        margin-top:1em; padding-top:1em; display: flex;justify-content: space-around;flex-direction: row;align-items: flex-start;
    }

    @media only screen and (max-width: 1024px) {
        div.quote { display:block; }
        div.block-bucket { margin-left:auto; margin-right:auto; }
        div.disclaimer {

        }
    }
</style>

<script>

/* Lead Form Script */
$(document).ready(function() {
    $('.lead-gen-button').click(function() {
        window.location.href = '/';
    });
});

</script>

<div class="lead-gen-module-container lead-gen-main">
    <div class="lead-gen-module">
        <h2><span style="text-transform:uppercase;">{{ $user->name }},</span></h2>
        <h2>Your Quote <span></span></h2>
    </div>
</div>

<div class="lead-gen-form-container lead-gen-main">
    <div class="lead-gen-form">
        <div id="lg-form-services">
            <p class="lg-section-heading marginx2" style="padding-top:1.5em; padding-bottom:0.5em; color: #7F8992 !important;">
                Your booking has been forwarded to one of our representatives.
            </p>
        </div>
    </div>
</div>

<div class="lead-gen-form-container lead-gen-main" style="background: #F2F6F9; margin-top:2em;">
    <div class="lead-gen-form">
        <div id="lg-form-personal">
            <div id="lg-form-submit" style="padding:40px 0;">
                <button type="button" class="lead-gen-button">Get Another Quote</button>
            </div>
        </div>
    </div>
</div>

@endsection