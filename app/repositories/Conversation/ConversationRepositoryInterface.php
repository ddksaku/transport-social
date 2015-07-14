<?php namespace Repositories\Conversation;

interface ConversationRepositoryInterface {
	public function all();

	public function find($id);

	public function addUsers($userIds, $conversationId);

	public function exists($ids);

	public function create();

}