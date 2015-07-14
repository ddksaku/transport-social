<?php
use Repositories\Conversation\ConversationRepositoryInterface as Conversation;
use Repositories\User\UserRepositoryInterface as User;

class ConversationController extends BaseController {

	protected $conversations;
	protected $users;

	public function __construct(Conversation $conversations, User $users) {
		$this->conversations = $conversations;
		$this->users = $users;
	}

	public function create($userId) {
		$auth = new Services\Auth;
		$user = $auth->GetUserInfo();

		if((int)$userId == $user->id) {
			return Redirect::route('messages.contacts')->withErrors(array('Cannot start conversation with yourself'));
		}

		if(!$this->users->hasFriend($user, $userId)) {
			return Redirect::route('messages.contacts')->withErrors(array('You cannot start a conversation with someone who is not your friend'));
		}

		$userId = array((int)$userId, $user->id);

		$conversation = $this->conversations->exists($userId);
		if($conversation == null) {
			$conversation = $this->conversations->create();
			$conversation = $this->conversations->addUsers($userId, $conversation->id);
		}
		return Redirect::route('conversation.view', array('id' => $conversation->id));
	}

	public function addUser($userIds, $conversationId) {
		$this->conversations->addUsers($userIds, $conversationId);
	}

	public function view($id) {
		$data['conversation'] = $this->conversations->find($id);
		return View::make('conversations.view')->with($data);
	}

}
