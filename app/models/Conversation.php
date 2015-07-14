<?php

class Conversation extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function users() {
		return $this->belongsToMany('User');
	}

	public function messages(){
  	return $this->hasMany('Message');
  }
}
