<?php namespace Services;


class Auth {

	public $errors = array();

	public function __construct() {
		$throttleProvider = \Sentry::getThrottleProvider();
		$throttleProvider->disable();
	}

	public function getUserInfo()
	{
		return \Sentry::getUser();
	}

	public function login($fields)
	{
		try {
			\Sentry::authenticate(
				array(
					'email' => $fields['email'] ,
					'password' => $fields['password'],
				) ,
				false
			);
		}
		catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		  $this->errors[] = trans('auth.password_reqiured');
		}
		catch (\Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
		  $this->errors[] = trans('auth.wrong_password');
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		  $this->errors[] = trans('auth.user_not_found');
		}
		catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
		  $this->errors[] = trans('auth.user_not_activated');
		}
	}

	public function activate($activation_code, $id) {
		try
		{
		    $user = \Sentry::findUserById($id);
		    $user->attemptActivation($activation_code);
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    $this->errors[] = trans('auth.user_not_found');
		}
		catch (\Cartalyst\Sentry\Users\UserAlreadyActivatedException $e)
		{
		    $this->errors[] = trans('auth.user_already_activated');
		}
	}

	public function logout()
	{
		\Sentry::logout();
	}

	public function register($fields, $groupname) {
		try {
			$user = \Sentry::register(
			array(
				'email' => $fields['email'] ,
				'first_name' => $fields['first_name'] ,
				'last_name' => $fields['last_name'] ,
				'password' => $fields['password'] ,
			));
		}
		catch(\Cartalyst\Sentry\Users\UserExistsException $e)
		{
			$this->errors[] = trans('auth.user_exists');
		}

		$group = \Sentry::getGroupProvider()->findByName($groupname);
		$user->addGroup($group);

		return $user;
	}

	public function update($fields)
	{
		try {
			$user = \Sentry::getUser();

			$user->first_name = $fields['first_name'];
			$user->last_name = $fields['last_name'];
			$user->email = $fields['email'];
			$user->company = $fields['occupation'];
			$user->country = $fields['country'];
			$user->birthday = $fields['birthday'];
			$user->about_me = $fields['about_me'];
			$user->hobbies = $fields['hobbies'];
			$user->musics = $fields['musics'];
			$user->movies = $fields['movies'];
			$user->books = $fields['books'];

			$user->save();
		}
		catch (\Cartalyst\Sentry\Users\UserExistsException $e)
		{
			$this->errors[] = trans('auth.user_exists');
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			$this->errors[] = trans('auth.user_not_found');
		}

		return $user;
	}

	public function send_activation_email($user) {
		//Send activation code to the user so he can activate the account
		$data = array(
			'name'		 => $user->name,
			'email'      => $user->email,
			'activation' => $user->getActivationCode(),
			'id'		 => $user->id,
		);

		\Mail::send('emails.auth.activateuser' , $data , function($message) use ($data)
		{
			$message->to($data['email'] , 'Example')->subject('email signup');
		});
	}

	public function send_reset_code_to_email($input)
	{
		try
		{
			$user = \Sentry::findUserByLogin($input['email']);
			$reset_code = $user->getResetPasswordCode();
			$data = array(
				'email' => $input['email'],
				'password' => $input['password'],
				'reset_code' => $reset_code
			);

			\Mail::send('emails.auth.reminder' , $data , function($message) use ($data)
			{
				$message->to($data['email'] , 'You')->subject(trans('user_auth.reset_password_label'));
			});
		}
		catch(\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			$this->errors[] = trans('auth.user_not_found');
		}
	}

	public function reset_password($email , $password , $reset_code)
	{
		try
		{
		    $user = \Sentry::findUserByLogin($email);

		    if ($user->checkResetPasswordCode($reset_code))
		    {
		        
		        if ($user->attemptResetPassword($reset_code, $password))
		        {
		            // Password reset passed
			        return;
		        }
		        else
		        {
		            $this->errors[] = trans('auth.reset_password_failed');
		        }
		    }
		    else
		    {
		        $this->errors[] = trans('auth.reset_password_code_invalid');
		    }
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			$this->errors[] = trans('auth.user_not_found');
		}
	}

	public function change_password($fields) 
	{
		try 
		{
			$user = \Sentry::getUser();

			$user->password = $fields['new_password'];
			$user->save();
		}
		catch(\Cartalyst\Sentry\Users\UserExistsException $e)
		{
			$this->errors[] = trans('auth.user_exists');
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			$this->errors[] = trans('auth.user_not_found');
		}

		return $user;
	}




}