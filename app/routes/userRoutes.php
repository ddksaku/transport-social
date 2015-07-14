<?php

Route::group(array('before' => 'guest'), function()
{
	Route::get('login',  array('as' => 'users.login', 'uses' => 'UsersController@login'));
	Route::post('login',  array('as' => 'users.auth', 'uses' => 'UsersController@auth'));

	Route::post('register', array('as' => 'users.register', 'uses' => 'UsersController@create'));
	Route::get('register', array('as' => 'users.registerForm', 'uses' => 'UsersController@register'));

	Route::post('resetpassword', array('as' => 'users.resetpassword', 'uses' => 'UsersController@resetpassword'));
	Route::get('resetpassword', array('as' => 'users.resetpasswordForm', 'uses' => 'UsersController@confirminfo'));

});

Route::group(array('before' => 'auth|auth.isUser'), function()
{
	Route::get('logout',  array('as' => 'users.logout', 'uses' => 'UsersController@logout'));

	Route::get('user/{id}/profile', array('as' => 'user.profile', 'uses' => 'UsersController@profile'))
		 ->where(array('id' => '[0-9]+'));

	Route::post('user/profile/edit_profile_pic' , array('as' => 'user.edit_profile_pic' , 'uses' => 'UsersController@edit_profile_pic'));
	Route::post('user/profile/add_photo' , array('as' => 'user.add_photo' , 'uses' => 'UsersController@add_photo'));

	Route::get('user/profile/edit' , array('as' => 'user.edit_profile' , 'uses' => 'UsersController@edit_profile'));
	Route::post('user/profile/edit' , array('as' => 'user.update' , 'uses' => 'UsersController@update'));

	Route::get('user/profile/change_password' , array('as' => 'user.change_password' , 'uses' => 'UsersController@change_password'));
	Route::post('user/profile/change_password' , array('as' => 'user.update_password' , 'uses' => 'UsersController@update_password'));

});

Route::get('user/{id}/activate/{activation_code}', array('as' => 'user.activate', 'uses' => 'UsersController@activate'))
		->where(array('id' => '[0-9]+'));

Route::get('user/{email}/{password}/activate/{reset_code}', array('as' => 'user.activate_reset_password', 'uses' => 'UsersController@activate_reset_password'));
