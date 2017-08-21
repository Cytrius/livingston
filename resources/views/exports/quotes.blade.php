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
            @if($quote->origin_pickup) Yes @endif
            @if(!$quote->origin_pickup) No @endif
        </td>
        <td class="collapsing" style="text-align:center">
            @if($quote->destination_delivery) Yes @endif
            @if(!$quote->destination_delivery) No @endif
        </td>
        <td class="collapsing" style="text-align:center">
            @if($quote->is_booked) Yes @endif
            @if(!$quote->is_booked) No @endif
        </td>
        <td style="text-align:right">{{ number_format($quote->total, 2, '.', '') }}</td>
    </tr>
    @endforeach
  </tbody>
</table>