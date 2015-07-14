<?php namespace Services\Validators;

class Register extends Validator {
	public static $rules = array (
		'first_name' => 'required',
		'last_name' => 'required',
		'email' => 'required|email',
		'password' => 'required',
		'repeat_password' => 'required|same:password'
	);
}
