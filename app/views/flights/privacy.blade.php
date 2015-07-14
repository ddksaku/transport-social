@extends('layouts.default')
@section('content')
  {{ Form::open(array('route' => array('flight.save', $flightId))) }}
    @include('_partials.errors')
    <div class="form-group">
      <p>Before you save your flight, select one of the option to determine who sees you attending this flight.</p>
      <label class="radio-inline">
        {{ Form::radio('privacy', '0') }}Only Friends
      </label>
      <label class="radio-inline">
        {{ Form::radio('privacy', '1') }}All Users
      </label>
      <label class="radio-inline">
        {{ Form::radio('privacy', '2') }}Only You
      </label>
    </div>
    <div class="form-group">
      {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
    </div>
  {{ Form::close() }}
@stop