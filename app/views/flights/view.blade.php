@extends('layouts.default')
@section('content')
  <div class="flightNumber">
    {{ $flight->carrier->iata }}
    {{ $flight->flightNumber }}
  </div>
  <div class="carrier">
    {{ $flight->carrier->name }}
  </div>
  <div class="route">
    {{ $flight->arrivalAirport->name.' to '.$flight->departureAirport->name }}
  </div>

  <div class="times">
    <p>Departure Time: {{ date(DATE_FORMAT, strtotime($flight->departureTime)) }}</p>
    <p>Arrival Time: {{ date(DATE_FORMAT, strtotime($flight->arrivalTime)) }}</p>
  </div>

  @if(count($flight->passengers) > 0)
    <p>
      @foreach($flight->passengers as $passenger)
        @if($passenger->profilePicture['path'] != '')
          <img src="{{ $passenger->profilePicture->path->thumb }}" width="20" height="20" />
        @else
          <img src="{{ DEFAULT_PROFILE_IMG }}" width="20" height="20" />
        @endif
      @endforeach
    </p>
  @endif

  @if(Sentry::check())
    @if(!$flight->saved)
      {{ link_to_route('flight.privacy', 'Save', array($flight->id), array('class' => 'btn btn-primary')) }}
    @else
      {{ link_to_route('flight.delete', 'Delete', array($flight->id), array('class' => 'btn btn-primary')) }}
    @endif
  @endif
@stop