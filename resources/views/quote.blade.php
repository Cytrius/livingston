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
    $('.lead-gen-button.grey').click(function() {
        window.location.href = '/';
    });
    $('.lead-gen-button:not(.grey)').click(function() {
        window.print();
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

            <div class="quote" style="">

                <div>

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
                        Quote #{{ $quote->id }}
                    </p>

                    <p class="lg-section-heading marginx2">
                        <i class="fa fa-car"></i>
                        Transport Your<br/><span class="information">{{ $form['cb_vehicleYear'] }} {{ $form['cb_vehicleMake'] }} {{ $form['cb_vehicleModel'] }}</span>
                    </p>
    
                    @if($quote->origin_pickup_rate && $quote->origin_pickup_rate !== 0)
                         <p class="lg-section-heading marginx2"><i class="fa fa-map-marker"></i> Pickup From<br/><span class="information"><span class="postal-code">{{ $quote->form_origin_postal }}</span>, <span class="city">{{ $quote->origin_pickup }}</span>, <span class="province">{{ $quote->form_origin_province }}</span></span></p>
                    @endif

                    @if($quote->rate !== 0)
                    <p class="lg-section-heading marginx2"><i class="fa fa-train"></i> Rail Transportation<br/><span class="information">{{ $quote->origin }} to {{ $quote->destination }}</span></p>
                    @endif

                    @if($quote->destination_delivery_rate && $quote->destination_delivery_rate !== 0)
                    <p class="lg-section-heading marginx2"><i class="fa fa-map-marker"></i> Delivery To<br/><span class="information"><span class="postal-code">{{ $quote->form_destination_postal }}</span>, <span class="city">{{ $quote->destination_delivery }}</span>, <span class="province">{{ $quote->form_destination_province }}</span></span></p>
                    @endif

                    <p class="disclaimer">
                        <i class="fa fa-exclamation-triangle"></i> Vehicles must be running, fully operational with a functioning e-brake
                    </p>

                    <p class="disclaimer">
                        <i class="fa fa-exclamation-triangle"></i> Due to Regulations; personal contents cannot be shipped with the vehicle. (Allowable contents include: Tires, car seats & emergency / safety kits)
                    </p>

                    <p class="disclaimer">
                        <i class="fa fa-exclamation-circle"></i> Please ensure to notify us if your vehicle has been modified i.e.: Lower, lifted, racks
                    </p>

                </div>

                <div>
                    @if($quote->origin_pickup_rate !== 0)
                    <div style="min-height:160px;max-height:none;height:auto;" class="block-bucket block-bucket-med blue-background">
                        <h3>Pickup To Delivery</h3>
                        <div class="description">
                            <p style="font-size:26px; color:#fff !important;">
                                <sup style="top: -5px;">$</sup>{{ money_format('%.2n', $quote->total) }}
                            </p>
                            <p style="margin-top:1em; font-size:14px; margin-bottom: 55px;">The overall transit times vary based on requested pickup & delivery locations as well as rail departure dates. Additional information available at time of booking.</p>
                        </div>

                        <a href="/book/{{ $quote->id }}"><button class="button small orange left absolute-bottom" style="">Book Now</button></a>
                    </div>
                    @endif

                    @if($quote->origin_pickup_rate > 0)
                    <div style="min-height:160px;max-height:none;height:auto;" class="block-bucket block-bucket-med orange-background white">
                    @else
                    <div style="min-height:160px;max-height:none;height:auto;" class="block-bucket block-bucket-med blue-background">
                    @endif
                        <h3>@if($quote->origin_pickup_rate !== 0) Option 2<br/> @endif Terminal To Terminal</h3>
                        <div class="description">
                            <p style="font-size:26px; color:#fff !important;">
                                @if($quote->origin_pickup_rate !== 0)
                                <sup style="top: -5px;">$</sup>{{ money_format('%.2n', $quote->alt_total) }}
                                @else
                                <sup style="top: -5px;">$</sup>{{ money_format('%.2n', $quote->total) }}
                                @endif
                            </p>
                            <p style="margin-top:1em; font-size:14px; margin-bottom: 55px;">The estimated transit time is {{ $quote->est_days }} days from the date of departure from the origin terminal</p>
                        </div>
                        @if($quote->origin_pickup_rate > 0)
                        <a href="/book/{{ $quote->id }}?alt=true"><button class="button small blue left absolute-bottom" style="">Book Now</button></a>
                        @else
                         <a href="/book/{{ $quote->id }}"><button class="button small orange left absolute-bottom" style="">Book Now</button></a>
                        @endif
                    </div>

                    <p class="disclaimer">
                        <i class="fa fa-info-circle"></i> Fuel surcharge, insurance, and applicable taxes included in all quotes above
                    </p>

                </div>

            </div>

        </div>

    </div>
</div>

<div class="lead-gen-form-container lead-gen-main" style="background: #F2F6F9; margin-top:2em;">
    <div class="lead-gen-form">
        <div id="lg-form-personal">
            <div id="lg-form-submit" style="padding:40px 0;">
                <button type="button" class="lead-gen-button">Print</button>
                <button type="button" class="lead-gen-button grey">Get Another Quote</button>
            </div>
        </div>
    </div>
</div>

@endsection