<?php namespace Services;

class PrivateMessage {

	public $errors = array();
	protected $users;

	public function __construct($users) {
		$this->users = $users;
	}

	public function suggest_user($term)
	{
		$users = $this->users->suggestFriends($term, \Sentry::getUser());
		$suggested_users = array();
		foreach($users as $user)
		{
				$suggested_users[] = $user->name;
		}
		return json_encode($suggested_users);
	}

	public function getContactData($fields)
	{
		$fullname = $fields['user_name'];
		$user = \Sentry::getUser();
		$contact = $this->users->getByName($fullname);

		if(is_null($contact)) {
			$this->errors[] = 'User not found';
			return;
		}

		return $save_data = array(
			'user_id' 			=>	$user->id,
			'contact_id'		=>	$contact->id,
			'contact_status'	=>	PENDING,
		);
	}
}
