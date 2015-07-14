@extends('layouts.default')
@section('content')
  @include('_partials.errors')
  {{ Form::open(array('route' => 'flights.by_airport'))}}
    <div class="form-group">
      <label for="arrivalAirportCode">Airport Code</label>
  		{{ Form::text('arrivalAirportCode', null, array('class' => 'form-control', 'id' => 'arrivalAirportCode')) }}
    </div>
    <div class="form-group">
      <label for="Date">Date</label>
      <div class="input-group date"  data-date-format="d-m-yyyy">
        {{ Form::text('date', date('j-n-Y'), array('class' => 'form-control')) }}
        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
      </div>
    </div>
    <div class="form-group">
      <label for="hour">Hour of Day</label>
      {{Form::select('hour', array('0' => '0000-0600', '6' => '0600-1200', '12' => '0600-1200', '18' => '1800-0000'), null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
      <label class="radio-inline">
        {{ Form::radio('direction', 'dep') }}Arriving
      </label>
      <label class="radio-inline">
        {{ Form::radio('direction', 'arr') }}Departing
      </label>
    </div>
    <div class="form-group">
      {{ Form::submit('Search', array('class' => 'btn btn-primary')) }}
    </div>
  {{ Form::close() }}
@stop

@include('_partials.assets.datepicker')

@section('scripts')
  <script>
    var url = "{{ URL::route('airports.suggest') }}";
    var selector = "#arrivalAirportCode";
  </script>
@stop

<?php Asset::container('assets')->add('autocomplete','js/autocomplete.js'); ?>
