<?php namespace Services\Validators;

class Login extends Validator {
	public static $rules = array (
		'email' => 'required|email',
		'password' => 'required',
	);
}
