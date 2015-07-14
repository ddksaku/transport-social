<?php namespace Repositories\Message;

interface MessageRepositoryInterface {

	public function all();

	public function find($id);

	public function create($fields, $conversation, $user);
}