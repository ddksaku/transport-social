<?php namespace Services\Validators;

class Contact extends Validator {
	public static $rules = array (
		'user_name' => 'required'
	);
}
