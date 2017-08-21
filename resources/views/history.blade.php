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

    table {
            width: 100%;
    margin-left: auto;
    margin-right: auto;
    margin-top: 0;
    margin-bottom: 0;
    max-width: 66.25rem;
    margin-top:2em;
    margin-bottom:2em;
    }
    table th {
        background-color:#004E9C;
        color:#fff;
    }
    table td, table th {
        text-align:left;
        padding:10px;
        font-size:16px;
    }
    table td {
        font-size:14px;
    }
    tbody tr:nth-child(odd) {
       background-color: #A8CAE6;
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
                    <h2>Your <span>Quote History</span></h2>

    </div>
</div>

<table class="ui small selectable celled table">
          <thead>
            <tr>
                <th>Quote Date</th>
                <th>Departure Date</th>
                <th>Account</th>
                <th>User</th>
                <th>Origin</th>
                <th>Destination</th>
                <th class="collapsing">Pickup</th>
                <th class="collapsing">Delivery</th>
                <th class="collapsing">Booked</th>
                <th style="text-align:right">Quote</th>
            </tr>
          </thead>
          <tbody>
            @foreach($quotes as $index=>$quote)
            <tr href="">
                <td>{{ $quote->created_at }}</td>
                <td>{{ $quote->departure_at }}</td>
                <td>{{ $quote->account->company }}</td>
                <td>{{ $quote->user->name }}</td>
                <td>{{ $quote->origin }}</td>
                <td>{{ $quote->destination }}</td>
                <td class="collapsing" style="text-align:center">
                    @if($quote->origin_pickup)<i class="fa fa-check"></i>@endif
                    @if(!$quote->origin_pickup)<i class="fa fa-close"></i>@endif
                </td>
                <td class="collapsing" style="text-align:center">
                    @if($quote->destination_delivery)<i class="fa fa-check"></i>@endif
                    @if(!$quote->destination_delivery)<i class="fa fa-close"></i>@endif
                </td>
                <td class="collapsing" style="text-align:center">
                    @if($quote->is_booked)<i class="fa fa-check"></i>@endif
                    @if(!$quote->is_booked)<i class="fa fa-close"></i>@endif
                </td>
                <td style="text-align:right">{{ number_format($quote->total, 2, '.', '') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

@endsection
