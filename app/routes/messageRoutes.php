<?php

Route::group(array('before' => 'auth'), function()
{
	Route::get('messages/inbox' , array('as' => 'messages.inbox', 'uses' => 'MessagesController@inbox'));

	Route::get('messages/contacts' , array('as' => 'messages.contacts' , 'uses' => 'MessagesController@contacts'));

	Route::post('messages/add_contact' , array('as' => 'messages.add_contact' , 'uses' => 'MessagesController@add_contact'));

	Route::post('messages/suggest_user' , array('as' => 'messages.suggest_user' , 'uses' => 'MessagesController@suggest_user'));

	Route::any('messages/send/{conversationId}', array('as' => 'message.send', 'uses' => 'MessagesController@send'))
				->where(array('conversationId' => '[0-9]+'));

	Route::any('contact/approve/{contactId}', array('as' => 'user.approve_contact', 'uses' => 'MessagesController@approve_contact'))
				->where(array('contactId' => '[0-9]+'));;

	Route::any('contact/delete/{contactId}', array('as' => 'user.delete_contact', 'uses' => 'MessagesController@delete_contact'))
				->where(array('contactId' => '[0-9]+'));;
});