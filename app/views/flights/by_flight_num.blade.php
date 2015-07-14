@extends('layouts.default')
@section('content')
  @include('_partials.errors')
  {{ Form::open(array('route' => 'flights.by_flight_num'))}}
    <div class="form-group">
      <label for="carrierCode">Carrier</label>
  		{{ Form::text('carrierCode', null, array('class' => 'form-control', 'id' => 'carrierCode')) }}
    </div>
    <div class="form-group">
      <label for="flightNumber">Flight Number</label>
      {{ Form::text('flightNumber', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
      <label for="Date">Date</label>
      <div class="input-group date"  data-date-format="d-m-yyyy">
        {{ Form::text('date', date('j-n-Y'), array('class' => 'form-control')) }}
        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
      </div>
    </div>
    <div class="form-group">
      {{ Form::submit('Search', array('class' => 'btn btn-primary')) }}
    </div>
  {{ Form::close() }}
@stop

@include('_partials.assets.datepicker')

@section('scripts')
  <script>
    var url = "{{ URL::route('carriers.suggest') }}";
    var selector = "#carrierCode";
  </script>
@stop

<?php Asset::container('assets')->add('autocomplete', 'js/autocomplete.js') ?>
