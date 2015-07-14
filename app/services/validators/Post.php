<?php namespace Services\Validators;

class Post extends Validator {
	public static $rules = array (
		'title' => 'required',
		'body' => 'required'
	);
}
