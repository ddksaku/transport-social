<?php namespace Repositories\Message;

use Message;

class EloquentMessageRepository implements MessageRepositoryInterface {
	public function all()
	{
		return Message::all();
	}

	public function find($id)
	{
		return Message::find($id);
	}

	public function create($fields, $conversation, $user)
	{
		$msg = new Message;
		$msg->message = $fields['message'];
		$msg->conversation()->associate($conversation);
		$msg->user()->associate($user);
		$msg->save();
		return $msg;
	}
}
