<?php namespace Repositories\Conversation;

use Conversation;

class EloquentConversationRepository implements ConversationRepositoryInterface {
	public function all()
	{
		return Conversation::all();
	}

	public function find($id)
	{
		return Conversation::find($id);
	}

	public function create()
	{
		$conversation = new Conversation;
		$conversation->name = 'Conversation';
		$conversation->save();
		return $conversation;
	}

	public function addUsers($userIds, $conversationId) {
		$conversation = $this->find($conversationId);
		$conversation->users()->attach($userIds);
		return $conversation;
	}

	public function exists($ids) {
		foreach ($this->all() as $conversation){
			$userIds = $conversation->users()->lists('user_id');
      if ($userIds === $ids)
        return $conversation;
    }
    return null;
	}
}
