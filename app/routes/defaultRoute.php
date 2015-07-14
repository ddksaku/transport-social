<?php

Route::group(array('before' => 'guest'), function()
{
	Route::get('/', array('as' => 'site.home', 'uses' => 'UsersController@login'));
});


