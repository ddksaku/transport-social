<?php namespace Services\Validators;

class ResetPassword extends Validator {
	public static $rules = array (
		'email' => 'required|email',
		'password' => 'required',
		'repeat_password' => 'required|same:password'
	);
}
