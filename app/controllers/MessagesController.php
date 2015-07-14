<?php

use Repositories\User\UserRepositoryInterface as User;
use Repositories\Message\MessageRepositoryInterface as Message;
use Repositories\Conversation\ConversationRepositoryInterface as Conversation;

class MessagesController extends BaseController {

	protected $users;
	protected $messages;
	protected $conversations;

	public function __construct(User $users, Message $messages, Conversation $conversations) {
		$this->users = $users;
		$this->messages = $messages;
		$this->conversations = $conversations;
	}

	public function inbox()
	{
		$auth = new Services\Auth;
		$user = $auth->GetUserInfo();

		$data['conversations'] = $this->users->get_conversations($user);
		$data['user'] = $user;

		return View::make('messages.inbox')->with($data);
	}

	public function contacts()
	{
		$auth = new Services\Auth;
		$data['user'] = $auth->GetUserInfo();
		$data['contacts'] = $this->users->get_contacts($data['user']);
		$data['pendingContacts'] = $this->users->get_pending_contacts($data['user']);

		return View::make('messages.contacts')->with($data);
	}

	public function suggest_user()
	{
		$msg = new Services\PrivateMessage($this->users);
		return $msg->suggest_user(Input::get('term'));
	}

	public function add_contact()
	{
		$msg = new Services\PrivateMessage($this->users);
		$validation = new Services\Validators\Contact;

		if($validation->passes())
		{
			$save_data = $msg->getContactData(Input::all());

			if(count($msg->errors) > 0)
			{
				return Redirect::back()->withInput()->withErrors($msg->errors);
			}

			$this->users->add_contact($save_data);
			return Redirect::route('messages.contacts');
		}

		return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	public function delete_contact($contactId) {
		$auth = new Services\Auth;
		$user = $auth->getUserInfo();
		$this->users->delete_contact($user, $contactId);
		return Redirect::route('messages.contacts');
	}

	public function approve_contact($contactId) {
		$auth = new Services\Auth;
		$user = $auth->getUserInfo();
		$this->users->approve_contact($user, $contactId);
		return Redirect::route('messages.contacts');
	}

	public function send($conversationId) {
		$auth = new Services\Auth;
		$user = $auth->GetUserInfo();
		$conversation = $this->conversations->find($conversationId);
		$message = $this->messages->create(Input::all(), $conversation, $user);
		return Redirect::route('conversation.view', array('id' => $conversationId));
	}

}