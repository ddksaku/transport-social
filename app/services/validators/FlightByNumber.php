<?php namespace Services\Validators;

class FlightByNumber extends Validator {
	public static $rules = array (
		'carrierCode' => 'required|exists:carriers,name',
		'flightNumber' => 'required|numeric',
		'date' => 'required|date_format:j-n-Y|date'
	);
}
