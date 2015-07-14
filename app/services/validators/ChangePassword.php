<?php namespace Services\Validators;

class ChangePassword extends Validator {
	public static $rules = array (
		'current_password'	=>'required',
		'new_password' => 'required',
		'repeat_password' => 'required|same:new_password'
	);
}
