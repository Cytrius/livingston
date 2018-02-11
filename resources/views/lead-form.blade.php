@extends('layouts.livingston')

@section('content')

<form class="lead-form" action="/quote" method="post" style="margin-bottom:0;" autocomplete="off">

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

    .lead-gen-button.grey {
        background-color:#bcc5ce !important;
    }

    .lead-gen-module {
        background-image:url('/images/car-keys.png');
    }

</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/2.5.7/flatpickr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/2.5.7/flatpickr.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js"></script>

<style>
    .ui-menu { transition:none; }
    .ui-menu * { transition:none; }

    .select2, .select2-container { transition:none; }
    .select2 *, .select2-container * { transition:none; }

    .select2 { min-width:311px; }

    .select2-selection.select2-selection--single {
        height:40px;
        background:#fff !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height:40px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height:38px;
        background:#fff !important;
        right:3px;
    }
}
</style>

<script>

/* Lead Form Script */
$(document).ready(function() {

    $("#departureDate").flatpickr({animate: false});

    /**
     * Select2 API Powered Dropdowns
     */

    $('#cb_originCity').select2({
        ajax: {
            url: function (params) {
                return '/api/dropdowns/origin/city?term='+params.term+'&local='+$('#cb_pickupRequired').is(':checked');
            },
            delay:100,
            processResults: function (data) {
                window.validTransport = data.valid;
                return {
                    results: data.items
                };
            }
        }
    });
    $('#cb_originCity').on('select2:select', function (evt) {
        if (evt.params.data && evt.params.data.province) {
            console.log(evt.params.data.province);
            $('#cb_originProvince').append($('<option value="'+evt.params.data.province+'">'+evt.params.data.province+'</option>'))
             $('#cb_originProvince').val(evt.params.data.province).trigger('change');
        } else {
            $('#cb_originProvince').val(null).trigger('change');
        }
        console.log('Is Valid Route', window.validTransport);
        checkValidRoute();
    });

    $('#cb_originProvince').select2({
        ajax: {
            url: function (params) {
                return '/api/dropdowns/origin/province?city='+$('#cb_originCity').val();
            },
            delay:100,
            processResults: function (data) {
                return {
                    results: data.items
                };
            }
        }
    });


    $('#cb_destCity').select2({
        ajax: {
            url: function (params) {
                return '/api/dropdowns/destination/city?term='+params.term+'&local='+$('#cb_deliveryRequired').is(':checked');;
            },
            delay:100,
            processResults: function (data) {
                window.validTransport = data.valid;
                return {
                    results: data.items
                };
            }
        }
    });
    $('#cb_destCity').on('select2:select', function (evt) {
        if (evt.params.data && evt.params.data.province) {
            console.log(evt.params.data.province);
            $('#cb_destProvince').append($('<option value="'+evt.params.data.province+'">'+evt.params.data.province+'</option>'))
             $('#cb_destProvince').val(evt.params.data.province).trigger('change');
        } else {
            $('#cb_destProvince').val(null).trigger('change');
        }
        console.log('Is Valid Route', window.validTransport);
        checkValidRoute();
    });
    $('#cb_destProvince').select2({
        ajax: {
            url: function (params) {
                return '/api/dropdowns/destination/province?city='+$('#cb_destCity').val();
            },
            delay:100,
            processResults: function (data) {
                return {
                    results: data.items
                };
            }
        }
    });

    $('#cb_vehicleYear').select2({
        ajax: {
            url: function (params) {
                return '/api/dropdowns/vehicle/years?term='+params.term;
            },
            delay:100,
            processResults: function (data) {
                return {
                    results: data
                };
            }
        }
    });
    $('#cb_vehicleMake').select2({
        ajax: {
            url: function (params) {
                return '/api/dropdowns/vehicle/makes?term='+params.term;
            },
            delay:100,
            processResults: function (data) {
                return {
                    results: data
                };
            }
        }
    });

    $('#cb_vehicleModel').select2({
        ajax: {
            url: function (params) {
                return '/api/dropdowns/vehicle/models?make='+$('#cb_vehicleMake').val()+'&term='+params.term;
            },
            delay:100,
            processResults: function (data) {
                return {
                    results: data
                };
            }
        }
    });
    $('#cb_vehicleModel').on('select2:select', function (evt) {
        if (evt.params.data && evt.params.data.type) {
            if (evt.params.data.type === 'C')
                $('#cb_vehicleType').val('car');
            if (evt.params.data.type === 'S')
                $('#cb_vehicleType').val('van');
            if (evt.params.data.type === 'T')
                $('#cb_vehicleType').val('os');
            if (evt.params.data.type === 'V')
                $('#cb_vehicleType').val('van');
        }
    });

    /**
     * Form Animation Fade In Out
     */

    $('#departureDate').change(function() {
        if ($(this).val().length) {
            $('.section-2').fadeIn();
            if (!$('#cb_pickupRequired').is(":checked"))
                $('#cb_pickupRequired').click();
        } else {
            $('.section-2, .section-3').hide();
        }
        notEnoughDetail();
    });

    $('#cb_pickupRequired').change(function() {
        if($(this).is(":checked")) {
            $('#cb_pickupRequired').parents('.checkbox-group').css({opacity:1});
            $('#cb_pickupNoRequired').prop('checked', false);
            $('#cb_pickupNoRequired').parents('.checkbox-group').css({opacity:0.3});
            $('#cb_originCity').parents('.hidden').fadeIn();
            $('#cb_originProvince').parents('.hidden').fadeIn();
            $('#cb_originPostalCode').parents('.hidden').fadeIn();
        } else {
            $('#cb_pickupNoRequired').parents('.checkbox-group').css({opacity:1});
            $('#cb_originCity').parents('.hidden').hide();
            $('#cb_originProvince').parents('.hidden').hide();
            $('#cb_originPostalCode').parents('.hidden').hide();
        }
        notEnoughDetail();
    });

    $('#cb_pickupNoRequired').change(function() {
        if($(this).is(":checked")) {
            $('#cb_pickupNoRequired').parents('.checkbox-group').css({opacity:1});
            $('#cb_pickupRequired').prop('checked', false);
            $('#cb_pickupRequired').parents('.checkbox-group').css({opacity:0.3});
            $('#cb_originCity').parents('.hidden').fadeIn();
            $('#cb_originProvince').parents('.hidden').hide();
            $('#cb_originPostalCode').parents('.hidden').hide();
        } else {
            $('.section-2-2, .section-3').hide();
            $('#cb_pickupRequired').parents('.checkbox-group').css({opacity:1});
            $('#cb_originCity').parents('.hidden').hide();
            $('#cb_originProvince').parents('.hidden').hide();
            $('#cb_originPostalCode').parents('.hidden').hide();
        }
        notEnoughDetail();
    });

    $('#cb_originCity,#cb_originProvince,#cb_originPostalCode').on('change keyup', function() {
        if ($('#cb_pickupRequired').is(":checked")) {
            if (
                $('#cb_originCity').val() && $('#cb_originCity').val().length &&
                $('#cb_originProvince').val() && $('#cb_originProvince').val().length &&
                /*$('#cb_originPostalCode').val() && $('#cb_originPostalCode').val().length &&*/
                window.validTransport
            ) {
                $('.section-2-2').fadeIn();
                if (!$('#cb_deliveryRequired').is(":checked"))
                    $('#cb_deliveryRequired').click();
            } else {
                $('.section-2-2, .section-3').hide();
            }
        }
        if ($('#cb_pickupNoRequired').is(":checked")) {
            console.log($('#cb_originCity').val().length,window.validTransport );
            if (
                $('#cb_originCity').val().length &&
                window.validTransport
            ) {
                $('.section-2-2').fadeIn();
                if (!$('#cb_deliveryRequired').is(":checked"))
                    $('#cb_deliveryRequired').click();
            } else {
                $('.section-2-2, .section-3').hide();
            }
        }
        notEnoughDetail();
    });

    $('#cb_deliveryRequired').change(function() {
        if($(this).is(":checked")) {
            $('#cb_deliveryRequired').parents('.checkbox-group').css({opacity:1});
            $('#cb_deliveryNoRequired').prop('checked', false);
            $('#cb_deliveryNoRequired').parents('.checkbox-group').css({opacity:0.3});
            $('#cb_destCity').parents('.hidden').fadeIn();
            $('#cb_destProvince').parents('.hidden').fadeIn();
            $('#cb_destPostalCode').parents('.hidden').fadeIn();
        } else {
            $('#cb_deliveryNoRequired').parents('.checkbox-group').css({opacity:1});
            $('.section-3').fadeOut();
            $('#cb_destCity').parents('.hidden').hide();
            $('#cb_destProvince').parents('.hidden').hide();
            $('#cb_destPostalCode').parents('.hidden').hide();
        }
        notEnoughDetail();
    });

    $('#cb_deliveryNoRequired').change(function() {
        if($(this).is(":checked")) {
            $('#cb_deliveryNoRequired').parents('.checkbox-group').css({opacity:1});
            $('#cb_deliveryRequired').prop('checked', false);
            $('#cb_deliveryRequired').parents('.checkbox-group').css({opacity:0.3});
            $('#cb_destCity').parents('.hidden').fadeIn();
            $('#cb_destProvince').parents('.hidden').hide();
            $('#cb_destPostalCode').parents('.hidden').hide();
        } else {
            $('#cb_deliveryRequired').parents('.checkbox-group').css({opacity:1});
            $('.section-3').fadeOut();
            $('#cb_destCity').parents('.hidden').hide();
            $('#cb_destProvince').parents('.hidden').hide();
            $('#cb_destPostalCode').parents('.hidden').hide();
        }
        notEnoughDetail();
    });

    $('#cb_destCity,#cb_destProvince,#cb_destPostalCode').on('change keyup', function() {
        if ($('#cb_deliveryRequired').is(":checked")) {
            if (
                $('#cb_destCity').val() && $('#cb_destCity').val().length &&
                $('#cb_destProvince').val() && $('#cb_destProvince').val().length &&
                /*$('#cb_destPostalCode').val() && $('#cb_destPostalCode').val().length &&*/
                window.validTransport
            ) {
                $('.section-3').fadeIn();
                if (!$('#vehicleCanBeDriven, #vehicleHasParkingBreak, #vehicleEmpty').is(":checked"))
                    $('#vehicleCanBeDriven, #vehicleHasParkingBreak, #vehicleEmpty').click();
            } else {
                $('.section-3').fadeOut();
            }
        }
        if ($('#cb_deliveryNoRequired').is(":checked")) {
            if (
                $('#cb_destCity').val().length &&
                window.validTransport
            ) {
                 $('.section-3').fadeIn();
                if (!$('#vehicleCanBeDriven, #vehicleHasParkingBreak, #vehicleEmpty').is(":checked"))
                    $('#vehicleCanBeDriven, #vehicleHasParkingBreak, #vehicleEmpty').click();
            } else {
                $('.section-3').fadeOut();
            }
        }
        notEnoughDetail();
    });

    $('#vehicleCanBeDriven, #vehicleHasParkingBreak, #vehicleEmpty').change(function() {
        if($('#vehicleCanBeDriven').is(":checked") && $('#vehicleHasParkingBreak').is(":checked") && $('#vehicleEmpty').is(":checked")) {
            $('.section-3-2').fadeIn();
            $('.disclaimer').hide();
        } else {
            $('.disclaimer').fadeIn();
            $('.section-3-2').hide();
        }
        notEnoughDetail();
    });

    $('#cb_vehicleType,#cb_vehicleYear,#cb_vehicleMake,#cb_vehicleModel').change(function() {
            if (
                $('#cb_vehicleType').val() &&
                $('#cb_vehicleYear').val() &&
                $('#cb_vehicleMake').val() &&
                $('#cb_vehicleModel').val()
            ) {
                $('.lead-gen-not-enough').fadeOut(300, function() {
                    $('.lead-gen-details').fadeIn();
                });
            } else {
                notEnoughDetail();
            }
    });

    var notEnoughDetail = function() {
        $('.lead-gen-details:visible').fadeOut(300, function() {
            $('.lead-gen-not-enough').fadeIn();
        });

        setTimeout(function() {
            $('.lg-section-holder:visible:not(.after)').css({'border-bottom':'1px solid #B6BCC1'})
            $('.lg-section-holder:visible:not(.after)').last().css({'border-bottom':'none'});
        });
    }

    notEnoughDetail();

    var checkValidRoute = function() {
        if (!window.validTransport) {
            $('.lead-gen-not-valid-route').fadeIn();
        } else {
            $('.lead-gen-not-valid-route').fadeOut();
        }
    }

    $('.lead-gen-button.grey').click(function() {
        $('.contact-info-static').hide();
        $('.lead-gen-button.grey').hide();
        $('.contact-info').fadeIn();
    });

    $('.contact-anyway').click(function() {
        $('.lead-gen-button:not(.grey)').text('Get A Quote');
        $('.lead-gen-not-enough').fadeOut(300, function() {
            $('.lead-gen-details').fadeIn();
        });
        return false;
    });

    $('.lead-gen-button:not(.grey)').click(function() {
        $('form.lead-form').submit();
    });

});

</script>

<div class="lead-gen-module-container lead-gen-main">
    <div class="lead-gen-module">
         <h2><span style="text-transform:uppercase;">{{ $user->name }},</span></h2>
                    <h2>GET AN <span>INSTANT QUOTE.</span></h2>

    </div>
</div>

<div class="lead-gen-form-container lead-gen-main">
    <div class="lead-gen-form">
        <div id="lg-form-services">

            <div class="lg-section-holder section-1">

                <p class="lg-section-heading marginx2">Let us provide you with a real-time quote:</p>

                <div style="height: 72px;">
                    <div class="lg-subsection-holder" style="opacity: 1;">
                        <label for="departureDate" class="lg-section-subheading">Expected Departure Date</label>
                        <input id="departureDate" name="departureDate" value="" type="text" class="text">
                        <small>* Weekend departure dates will be booked for the following business day.</small>
                    </div>
                </div>
            </div>

            <div class="lg-section-holder section-2">

                <p class="lg-section-heading marginx2">Do you need a pick-up service at the origin?</p>
                <div class="lg-section-content">

                    <div class="checkbox-group">
                        <input id="cb_pickupRequired" name="cb_pickupRequired" type="checkbox" value="yes">
                        <label for="cb_pickupRequired">Yes, I need the shipment picked up.</label>
                    </div>
                    <br/>
                    <div class="checkbox-group">
                        <input id="cb_pickupNoRequired" name="cb_pickupNoRequired" type="checkbox" value="yes">
                        <label for="cb_pickupNoRequired">No, I will drop off the shipment at the terminal.</label>
                    </div>

                    <br/>

                    <div class="marginx3 hidden" style="height: 72px;">
                        <div class="lg-subsection-holder" style="opacity: 1;">
                            <label for="cb_originCity" class="lg-section-subheading">Origin City</label>
                            <select id="cb_originCity" name="cb_originCity"></select>
                        </div>
                    </div>

                    <div class="marginx3 hidden" style="height: 72px;">
                        <div class="lg-subsection-holder" style="opacity: 1;">
                            <label for="cb_originProvince" class="lg-section-subheading">Origin State/Province</label>
                            <select id="cb_originProvince" name="cb_originProvince"></select>
                        </div>
                    </div>

                    <div class="hidden" style="height: 72px;">
                        <div class="lg-subsection-holder" style="opacity: 1;">
                            <label for="cb_originPostalCode" class="lg-section-subheading">Origin Postal Code</label>
                            <input id="cb_originPostalCode" name="cb_originPostalCode" value="" type="text" class="text">
                        </div>
                    </div>

                </div>

                <div class="section-2-2">
                    <br/><br/>
                    <p class="lg-section-heading marginx2">Do you need a delivery service at the destination?</p>
                    <div class="lg-section-content">
                        <div class="checkbox-group">
                            <input id="cb_deliveryRequired" name="cb_deliveryRequired" type="checkbox" value="yes">
                            <label for="cb_deliveryRequired">Yes, I need the shipment delivered.</label>
                        </div>
                        <br/>
                        <div class="checkbox-group">
                            <input id="cb_deliveryNoRequired" name="cb_deliveryNoRequired" type="checkbox" value="yes">
                            <label for="cb_deliveryNoRequired">No, I will pick up the shipment at the terminal.</label>
                        </div>
                        <br/>
                        <div class="marginx3 hidden" style="height: 72px;">
                            <div class="lg-subsection-holder" style="opacity: 1;">
                                <label for="cb_destCity" class="lg-section-subheading">Destination City</label>
                                <select id="cb_destCity" name="cb_destCity"></select>
                            </div>
                        </div>

                        <div class="marginx3 hidden" style="height: 72px;">
                            <div class="lg-subsection-holder" style="opacity: 1;">
                                <label for="cb_destProvince" class="lg-section-subheading">Destination State/Province</label>
                                <select id="cb_destProvince" name="cb_destProvince"></select>
                            </div>
                        </div>

                        <div class="hidden" style="height: 72px;">
                            <div class="lg-subsection-holder" style="opacity: 1;">
                                <label for="cb_destPostalCode" class="lg-section-subheading">Destination Postal Code</label>
                                <input id="cb_destPostalCode" name="cb_destPostalCode" value="" type="text" class="text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg-section-holder lead-gen-not-valid-route hidden" style="border-bottom:none; padding-top:0;">
                <div class="lg-section-holder after" style="border: none; padding-bottom:0">
                    <p class="lg-section-heading marginx3" style="font-size: 22px !important; margin-bottom:0">
                    <i class="fa fa-2x fa-warning" style="color:#fc2214; float: left;padding-right: 0.5em;padding-top: 0.1em;"></i> It does not appear that we have real-time rates for the selected origin or destination. Please correct your selection, or <a href="#" class="contact-anyway">contact us below</a> for a custom quote.</p>
                </div>
            </div>

            <div class="lg-section-holder section-3" style="border-bottom:none;">
                <p class="lg-section-heading marginx2">Vehicle is in operable condition?</p>
                <div class="lg-section-content">
                    <div class="checkbox-group">
                        <input id="vehicleCanBeDriven" name="vehicleCanBeDriven" type="checkbox" value="yes">
                        <label for="vehicleCanBeDriven">Yes, vehicle is operable.</label>
                    </div>
                </div>
                <br/>
                <p class="lg-section-heading marginx2">Vehicle has functioning parking break?</p>
                <div class="lg-section-content">
                    <div class="checkbox-group">
                        <input id="vehicleHasParkingBreak" name="vehicleHasParkingBreak" type="checkbox" value="yes">
                        <label for="vehicleHasParkingBreak">Yes, vehicle has functioning parking break.</label>
                    </div>
                </div>
                <br/>
                <p class="lg-section-heading marginx2">Vehicle contains no personal effects?</p>
                <div class="lg-section-content">
                    <div class="checkbox-group">
                        <input id="vehicleEmpty" name="vehicleEmpty" type="checkbox" value="yes">
                        <label for="vehicleEmpty">Yes, vehicle contains no personal effects.</label>
                    </div>
                </div>
                <br/>
                <div class="disclaimer">
                    <div class="lg-section-holder after" style="border: none; padding-bottom:0">
                        <p class="lg-section-heading marginx3" style="font-size: 22px !important; margin-bottom:0">
                        <i class="fa fa-2x fa-warning" style="color:#fc2214; float: left;padding-right: 0.5em;padding-top: 0.1em;"></i> It is required that the vehicle can be driven, has function parking breaks, and contains no personal effects in order for us to provide you a real-time quote.</p>
                    </div>
                </div>
                <br/>
                <div class="section-3-2">

                    <div class="row marginx2">
                        <div class="row-item" style="display:block; float:left">
                            <div class="field-label">Year</div>
                            <select id="cb_vehicleYear" name="cb_vehicleYear"></select>
                        </div>
                        <div class="row-item" style="display:block; float:left">
                            <div class="field-label">Make</div>
                            <select id="cb_vehicleMake" name="cb_vehicleMake"></select>
                        </div>
                        <div class="row-item" style="display:block; float:left">
                            <div class="field-label">Model</div>
                            <select id="cb_vehicleModel" name="cb_vehicleModel"></select>
                        </div>
                    </div>

                    <small>* Transportation of classic cars or vehicles not listed above requires that you contact us for a custom quote</small>

                    <!-- hidding type -->
                    <div style="display:none">
                        <div class="marginx3" style="height: 72px;" style="display:none;">
                            <div class="lg-subsection-holder" style="opacity: 1;">
                                <label for="cb_vehiclType" class="field-label">Vehicle Type</label>
                                <div id="pd_country" style="height:auto;">
                                    <!--<select id="cb_vehicleType" name="cb_vehicleType"></select>-->
                                    <select name="cb_vehicleType" id="cb_vehicleType" style="width:311px; background-color:#fff;">
                                        <option value=""></option>
                                        <option value="car" selected="selected">Car</option>
                                        <option value="van">Van</option>
                                        <option value="suv">Suv</option>
                                        <option value="truck">Small Truck</option>
                                        <option value="os">Oversized Vehicle</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<div class="lead-gen-form-container lead-gen-main lead-gen-not-enough" style="background: #F2F6F9; margin-top:0em;">
    <div class="lead-gen-form">
        <div id="lg-form-personal">
            <!-- FORM: Personal Details -->
            <div class="lg-section-holder after" style="border: none;">
                <p class="lg-section-heading marginx3" style="font-size: 22px !important;">Please complete the above form for a real-time quote.</p>
                <p class="lg-section-heading marginx3" style="font-size: 22px !important; margin-bottom:0;">Or, <a href="http://vehicletransportation.ca/about-us/contact-us/" class="contact-anyway-link">Contact us here</a> and a sales representative can assist you.</p>
            </div>
        </div>
    </div>
</div>

<div class="lead-gen-form-container lead-gen-main lead-gen-details" style="background: #F2F6F9;">
    <div class="lead-gen-form">
        <div id="lg-form-personal">
            <!-- FORM: Personal Details -->
            <div class="lg-section-holder" style="border: none;">

                <p class="lg-section-heading marginx3 visible contact-info-static" style="margin-bottom:0">A copy of this quote will be sent to {{ $user->email }}.</p>


                <p class="lg-section-heading marginx3 hidden contact-info">Who should we contact about this quote?</p>

                <div class="lg-section-content hidden contact-info" style="margin-bottom:0">
                    <div class="marginx1 form-check form-check-email">
                        <label class="" for="contact_email">Email *</label>
                        <input type="text" class="" name="contact_email" id="contact_email" value="{{ $user->email }}" size="30" maxlength="255">
                        <span class="errormsg">Please enter a valid email address.</span>
                    </div>
                    <div class="marginx1 form-check">
                        <label class="" for="contact_first_name">First Name *</label>
                        <input type="text" class="" name="contact_first_name" id="contact_first_name" value="{{ explode(' ', $user->name)[0] }}" size="30" maxlength="40">
                        <span class="errormsg">Please provide your first name.</span>
                    </div>
                    <div class="marginx1 form-check">
                        <label class="" for="contact_last_name">Last Name *</label>
                        <input type="text" class="" name="contact_last_name" id="contact_last_name" value="{{ explode(' ', $user->name)[1] }}" size="30" maxlength="80">
                        <span class="errormsg">Please provide your last name.</span>
                    </div>
                    <div class="marginx1 form-check form-check-phone">
                        <label class="" for="contact_business_phone">Business Phone *</label>
                        <input type="text" class="" name="contact_business_phone" id="contact_business_phone" size="30" maxlength="40" value="{{ $user->phone ? $user->phone : $account->phone }}">
                        <span class="errormsg">Please provide a valid telephone number.</span>
                    </div>
                    <div class="marginx1 form-check form-check-ignore">
                        <label class="" for="contact_company">Company *</label>
                        <input type="text" class="" name="contact_company" id="contact_company" size="30" maxlength="255" value="{{ $account->company }}">
                        <span class="errormsg">Please provide the name of your company.</span>
                    </div>
                    <div class="marginx1 form-check form-check-ignore">
                        <label class="" for="contact_address">Address *</label>
                        <input type="text" class="" name="contact_address" id="contact_address" size="30" maxlength="255" value="{{ $account->address }}">
                        <span class="errormsg">Please provide your address.</span>
                    </div>
                    <div class="marginx1 form-check form-check-ignore">
                        <label class="" for="contact_city">City *</label>
                        <input type="text" class="" name="contact_city" id="contact_city" size="30" maxlength="40" value="{{ $account->city }}">
                        <span class="errormsg">Please provide your city.</span>
                    </div>
                    <div id="pd_country" class="marginx1 form-check">
                        <label class="" for="contact_country">Country *</label>
                        <select name="contact_country" id="contact_country">
                            <option value=""></option>
                            @foreach(\Countries::all() as $country)
                                <option value="{{ $country->name }}" @if(strtolower($account->country) === strtolower($country->name) ) selected="selected" @endif>{{ $country->name }}</option>
                            @endforeach
                        </select>
                        <span class="errormsg">Please select your country.</span>
                    </div>
                    <div class="lg-subsection-holder">
                        <div id="pd_state" class="marginx1 form-check">

                            <div id="state_US">
                                <label class="" for="contact_state">State *</label>
                                <select name="contact_state" id="contact_state">
                                    <!-- <option value=""></option> -->
                                    <option value="">Please Select... </option>
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="DC">District Of Columbia</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                    </select>
                                <span class="errormsg">Please select your state.</span>
                            </div>

                            <div id="state_CA">
                                <label class="" for="contact_province">Province</label>
                                <select name="contact_province" id="contact_province">
                                    <!-- <option value=""></option> -->
                                    <option value="">Please Select... </option>
                                    <option value="AB">Alberta</option>
                                    <option value="BC">British Columbia</option>
                                    <option value="MB">Manitoba</option>
                                    <option value="NB">New Brunswick</option>
                                    <option value="NL">Newfoundland</option>
                                    <option value="NT">Northwest Territories</option>
                                    <option value="NS">Nova Scotia</option>
                                    <option value="NU">Nunavut</option>
                                    <option value="ON">Ontario</option>
                                    <option value="PE">Prince Edward Island</option>
                                    <option value="QC">Quebec</option>
                                    <option value="SK">Saskatchewan</option>
                                    <option value="YT">Yukon</option>
                                </select>
                                <span class="errormsg">Please select your province.</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div id="lg-form-submit">
                <button type="button" class="lead-gen-button">Get A Real-Time Quote</button>
                <button type="button" class="lead-gen-button grey">Edit Contact</button>
            </div>
        </div>
    </div>
</div>

</form>

@endsection
