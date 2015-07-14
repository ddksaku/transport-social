<?php namespace Services\Validators;

class FlightsByRoute extends Validator {
	public static $rules = array (
		'arrivalAirportCode' => 'required|exists:airports,name',
		'departureAirportCode' => 'required|exists:airports,name',
		'date' => 'required|date_format:j-n-Y|date'
	);
}
