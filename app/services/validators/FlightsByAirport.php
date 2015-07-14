<?php namespace Services\Validators;

class FlightsByAirport extends Validator {
	public static $rules = array (
		'arrivalAirportCode' => 'required|exists:airports,name',
		'hour' => 'required|numeric',
		'date' => 'required|date_format:j-n-Y|date',
		'direction' => 'required|max:3'
	);
}
