<?php

use Repositories\User\UserRepositoryInterface as User;
use Repositories\Photo\PhotoRepositoryInterface as Photo;
use Repositories\Country\CountryRepositoryInterface as Country;

class UsersController extends BaseController {

	protected $users;
	protected $photos;
	protected $countries;

	public function __construct(User $users, Photo $photos, Country $countries) {
		$this->users = $users;
		$this->photos = $photos;
		$this->countries = $countries;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    return View::make('users.index');
	}

	public function auth()
	{

		$validation = new Services\Validators\Login;
		$auth = new Services\Auth;

		if($validation->passes())
		{
			$auth->login(Input::all());
			if(count($auth->errors) > 0) {
				return Redirect::back()->withInput()->withErrors($auth->errors);
			}
			$user = $auth->GetUserInfo();
			return Redirect::route('user.profile', array('id' => $user->id));
			
		}
		return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	public function login() {
		return View::make('users.login');
	}

	public function register() {
		if(Auth::user()) return Redirect::route('site.home');
		return View::make('users.register');
	}

/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
   	$validation = new Services\Validators\Register;

		if($validation->passes()) {
			$auth = new Services\Auth;
			$user = $auth->register(Input::all(), 'Users');
			if(count($auth->errors) > 0) {
				return Redirect::back()->withInput()->withErrors($auth->errors);
			}
			$auth->send_activation_email($user);
			return Redirect::route('site.home');
		}
		return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	public function update()
	{
		$validation = new Services\Validators\UpdateProfile;

		if($validation->passes())
		{
			$auth = new Services\Auth;
			$user = $auth->update(Input::all());
			if(count($auth->errors) > 0) {
				return Redirect::back()->withInput->withErrors($auth->errors);
			}
			return Redirect::route('user.profile' , array('id' => $user->id));
			
		}
		return Redirect::back()->withInput->withErrors($validation->errors);
	}

	public function logout() {
		$auth = new Services\Auth;
		$auth->logout();
		return Redirect::route('site.home');
	}

	public function profile($id) {
		$auth = new Services\Auth;
		$user = $this->users->find($id);
		if(!$user) {
			return Redirect::route('site.home');
		}
		$picture = $this->users->getProfilePic($user);
		$data['photos'] = $this->users->getPhotos($user);
		$data['profile_pic'] = (count($picture) > 0 ? $picture->path->thumb : DEFAULT_PROFILE_IMG);
		if(isset($user->country)) {
			$data['country'] = $this->countries->findByCode($user->country);
		}
		$data['user'] = $user;
		return View::make('users.profile')->with($data);
	}

	public function edit_profile()
	{
		$auth = new Services\Auth;
		$data['user'] = $auth->getUserInfo();
		$picture = $this->users->getProfilePic($data['user']);
		$data['photos'] = $this->users->getPhotos($data['user']);
		$data['profile_pic'] = (count($picture) > 0 ? $picture->path->thumb : DEFAULT_PROFILE_IMG);
		$data['countries'] = $this->countries->listAll();
		return View::make('users.edit_profile')->with($data);
	}

	public function activate($id, $activation_code) {
		$auth = new Services\Auth;
		$auth->activate($activation_code, $id);
		if(count($auth->errors) > 0) {
			return View::make('users.activate')->with(array('error' => 'Your account could not be activated'));
		}
		return View::make('users.activate')->with(array('success' => 'Your account has been activated'));
	}

	public function edit_profile_pic()
	{
		if(Input::hasFile('profile_pic'))
		{
			$auth = new Services\Auth;
			$image = new Services\Image;
			$user = $auth->getUserInfo();
			$image->upload(Input::file('profile_pic'), 'photos');
			if(count($image->errors) > 0) {
				Redirect::back()->withErrors($image->errors);
			}
			$photo = $this->photos->create(array('path' => $image->path));
			$user = $this->users->saveProfilePic($photo, $user);
		}
		return Redirect::back();

	}

	public function add_photo()
	{
		$files = Input::file('files');
		if($files) {
			$auth = new Services\Auth;
			$image = new Services\Image;
			$user = $auth->getUserInfo();
			$photos = array();
			foreach($files as $file) {
				$image->upload($file, 'photos');
				if(count($image->errors) > 0) {
					Redirect::back()->withErrors($image->errors);
				}
				$photos[] = $this->photos->create(array('path' => $image->path));
			}
			$this->users->savePhotos($photos, $user);
		}
		return Redirect::back();
	}

	public function confirminfo() 
	{
		if(Auth::user()) 
			return Redirect::route('site.home');
		return View::make('users.resetpassword');
	}

	public function resetpassword()
	{
		$validation = new Services\Validators\ResetPassword;

		if($validation->passes()) {
			$auth = new Services\Auth;
			$auth->send_reset_code_to_email(Input::all());
			return Redirect::route('site.home');
		}
		return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	public function activate_reset_password($email, $password , $reset_code)
	{
		$auth = new Services\Auth;
		$auth->reset_password($email, $password , $reset_code);
		if(count($auth->errors) > 0) {
			return View::make('users.login')->with(array('info_errors' => trans('auth.could_not_password')));
		}
		$data = array('infos' => trans('auth.reseted_password_info').'"'.$password.'".');
		
		return View::make('users.login')->with($data);		
	}

	public function change_password()
	{
		$auth = new Services\Auth;
		$data['user'] = $auth->getUserInfo();
		$picture = $this->users->getProfilePic($data['user']);
		$data['photos'] = $this->users->getPhotos($data['user']);
		$data['profile_pic'] = (count($picture) > 0 ? $picture->path->thumb : DEFAULT_PROFILE_IMG);

		return View::make('users.change_password')->with($data);
	}

	public function update_password()
	{
		$validation = new Services\Validators\ChangePassword;

		if($validation->passes())
		{
			$auth = new Services\Auth;
			$user = $auth->change_password(Input::all());
			if(count($auth->errors) > 0) 
			{
				return Redirect::back()->withInput()->withErrors($auth->errors);
			}
			return Redirect::route('user.profile' , array('id' => $user->id));
		}
		return Redirect::back()->withInput->withErrors($validation->errors);
	}
}
			
		
		