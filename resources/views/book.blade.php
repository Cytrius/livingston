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
    $('.lead-gen-button:not(.grey)').click(function() {
        $('#book-form').submit();
    });
    $('.lead-gen-button.grey').click(function() {
        window.location.href = '/';
    });
});

</script>

<div class="lead-gen-module-container lead-gen-main">
    <div class="lead-gen-module">
        <h2><span style="text-transform:uppercase;">{{ $user->name }},</span></h2>
        <h2>Book Your Move <span>Now</span></h2>
    </div>
</div>

<div class="lead-gen-form-container lead-gen-main">
    <div class="lead-gen-form">
        <div id="lg-form-services">

            <div class="quote" style="">

               <div>
                    <form id="book-form" action="/book-confirm/{{ $quote->id}}" method="post">

                        <style>
                            span.information {
                                color: #004E9C;
                                font-size: 22px;
                                display: block;
                                line-height: 32px;
                                padding-top: 0.5em;
                                padding-bottom:0.5em;
                                margin-left:50px;
                            }
                            span.information .postal-code { text-transform:uppercase; }
                            span.information .city { text-transform:capitalize; }
                            span.information .province { text-transform:capitalize; }

                            .lg-section-heading .fa {
                                width:38px;
                            }

                            .disclaimer {
                                max-width:320px;
                                margin-bottom:1em;
                                color:#7F8992 !important;
                            }
                            .disclaimer .fa {
                                padding-right:0.25em;
                            }
                        </style>

                        <p class="lg-section-heading marginx2" style="padding-bottom:0.5em; color: #7F8992 !important;">
                            Quote #{{ $quote->id }} - Book Now
                        </p>

                        @if(!$origin_term)
                        <p class="lg-section-heading marginx3 contact-info">Contact at origin ({{ $quote->origin_pickup ? $quote->origin_pickup : $quote->origin }})?</p>

                        <div class="lg-section-content contact-info" style="margin-bottom:0">
                            <div class="marginx1 form-check form-check-email">
                                <label class="" for="origin_contact_name">Name *</label>
                                <input type="text" class="" name="origin_contact_name" id="origin_contact_name" size="30" maxlength="255">
                                <span class="errormsg">Please provide a full name.</span>
                            </div>
                            <div class="marginx1 form-check">
                                <label class="" for="origin_contact_phone">Phone Number *</label>
                                <input type="text" class="" name="origin_contact_phone" id="origin_contact_phone" size="30" maxlength="40">
                                <span class="errormsg">Please provide a phone number.</span>
                            </div>
                            <div class="marginx1 form-check">
                                <label class="" for="origin_contact_address">Street Address *</label>
                                <input type="text" class="" name="origin_contact_address" id="origin_contact_address" size="30" maxlength="40">
                                <span class="errormsg">Please provide the street address.</span>
                            </div>
                        </div>

                        @else

                        <p class="lg-section-heading marginx3 contact-info">Drop off address at origin ({{ $quote->origin_pickup ? $quote->origin_pickup : $quote->origin }})</p>

                        <div class="lg-section-content contact-info" style="margin-bottom:0">
                            <p><strong>{{ $origin_term->name }}</strong></p>
                            <p>{{ $origin_term->address }}</p>
                            <p>{{ $origin_term->city }}, {{ $origin_term->province }}, {{ $origin_term->postal_code }}</p>
                            <p>{{ $origin_term->operator }}</p>
                            <br/>
                            <p>{{ $origin_term->hours }}</p>
                            <p>Direct: {{ $origin_term->phone }}</p>
                            <p>Tracking Information: {{ $origin_term->tracking_phone }}</p>
                        </div>


                        @endif

                        <br/><br/>

                         @if(!$dest_term)
                        <p class="lg-section-heading marginx3 contact-info">Contact at destination ({{ $quote->destination_delivery ? $quote->destination_delivery : $quote->destination }})?</p>

                        <div class="lg-section-content contact-info" style="margin-bottom:0">
                            <div class="marginx1 form-check form-check-email">
                                <label class="" for="dest_contact_name">Name *</label>
                                <input type="text" class="" name="dest_contact_name" id="dest_contact_name" size="30" maxlength="255">
                                <span class="errormsg">Please provide a full name.</span>
                            </div>
                            <div class="marginx1 form-check">
                                <label class="" for="dest_contact_phone">Phone Number *</label>
                                <input type="text" class="" name="dest_contact_phone" id="dest_contact_phone" size="30" maxlength="40">
                                <span class="errormsg">Please provide a phone number.</span>
                            </div>
                            <div class="marginx1 form-check">
                                <label class="" for="dest_contact_address">Street Address *</label>
                                <input type="text" class="" name="dest_contact_address" id="dest_contact_address" size="30" maxlength="40">
                                <span class="errormsg">Please provide the street address.</span>
                            </div>
                        </div>

                        @else

                        <p class="lg-section-heading marginx3 contact-info">Pickup address at destination ({{ $quote->destination_delivery ? $quote->destination_delivery : $quote->destination }})</p>

                        <div class="lg-section-content contact-info" style="margin-bottom:0">
                            <p><strong>{{ $dest_term->name }}</strong></p>
                            <p>{{ $dest_term->address }}</p>
                            <p>{{ $dest_term->city }}, {{ $dest_term->province }}, {{ $dest_term->postal_code }}</p>
                            <p>{{ $dest_term->operator }}</p>
                            <br/>
                            <p>{{ $dest_term->hours }}</p>
                            <p>Direct: {{ $dest_term->phone }}</p>
                            <p>Tracking Information: {{ $dest_term->tracking_phone }}</p>
                        </div>

                        @endif

                    </form>

                </div>

                <div>
                    @if(intval($quote->origin_pickup_rate) !== 0)
                    <div style="min-height:160px;max-height:none;height:auto;" class="block-bucket block-bucket-med blue-background">
                        <h3>Pickup To Delivery</h3>
                        <div class="description">
                            <p style="font-size:26px; color:#fff !important;">
                                <sup style="top: -5px;">$</sup>{{ money_format('%.2n', $quote->total) }}
                            </p>
                            <p style="margin-top:1em; font-size:14px;">The overall transit times vary based on requested pickup & delivery locations as well as rail departure dates. Additional information available at time of booking.</p>
                        </div>
                    </div>
                    @endif

                    @if(!$quote->origin_pickup_rate || intval($quote->origin_pickup_rate) === 0)
                    <div style="min-height:160px;max-height:none;height:auto;" class="block-bucket block-bucket-med blue-background">
                        <h3>Terminal To Terminal</h3>
                        <div class="description">
                            <p style="font-size:26px; color:#fff !important;">
                                <sup style="top: -5px;">$</sup>{{ money_format('%.2n', $quote->total) }}
                            </p>
                            <p style="margin-top:1em; font-size:14px;">{{ $quote->tax_percent }}% Tax Included<!--The estimated transit time is {{ $quote->est_days }} days from the date of departure from the origin terminal--></p>
                        </div>
                    </div>
                     @endif

                    <p class="disclaimer">
                        <i class="fa fa-info-circle"></i> Fuel surcharge, insurance, and applicable taxes included in all quotes above
                    </p>

                </div>

            </div>

        </div>

    </div>
</div>

<div class="lead-gen-form-container lead-gen-main">
    <div class="lead-gen-form">
        <div id="lg-form-services">

        </div>
    </div>
</div>

<div class="lead-gen-form-container lead-gen-main" style="background: #F2F6F9; margin-top:2em;">
    <div class="lead-gen-form">
        <div id="lg-form-personal">
            <div id="lg-form-submit" style="padding:40px 0;">
                <button type="button" class="lead-gen-button">Book Now</button>
                <button type="button" class="lead-gen-button grey">Get Another Quote</button>
            </div>
        </div>
    </div>
</div>

@endsection
