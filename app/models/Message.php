<?php

class Message extends Eloquent {

	public function conversation() {
		return $this->belongsTo('Conversation');
	}

	public function user() {
		return $this->belongsTo('User');
	}

}