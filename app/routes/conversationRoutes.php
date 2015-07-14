<?php

Route::group(array('before' => 'auth'), function()
{
	Route::any('conversation/{id}/view', array('as' => 'conversation.view', 'uses' => 'ConversationController@view'))
			->where(array('id' => '[0-9]+'));

	Route::any('conversation/create/{userId}', array('as' => 'conversation.create', 'uses' => 'ConversationController@create'))
			->where(array('userId' => '[0-9]+'));
});
