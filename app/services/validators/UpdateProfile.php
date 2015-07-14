<?php namespace Services\Validators;

class UpdateProfile extends Validator {
	public static $rules = array (
		'first_name' => 'required',
		'last_name' => 'required',
		'email' => 'required|email',
	);
}
