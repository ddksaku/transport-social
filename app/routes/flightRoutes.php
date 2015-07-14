<?php

Route::any('search/flights/by-airport', array('as' => 'flights.by_airport', 'uses' => 'FlightsController@by_airport'));
Route::any('search/flights/by-route', array('as' => 'flights.by_route', 'uses' => 'FlightsController@by_route'));
Route::any('search/flights/by-flight-num', array('as' => 'flights.by_flight_num', 'uses' => 'FlightsController@by_flight_num'));

Route::any('flight/{id}/view', array('as' => 'flight.view', 'uses' => 'FlightsController@view'))
			 ->where(array('id' => '[0-9]+'));

Route::group(array('before' => 'auth'), function()
{
	Route::any('flight/{id}/privacy', array('as' => 'flight.privacy', 'uses' => 'FlightsController@privacy'))
			->where(array('id' => '[0-9]+'));;

	Route::any('flight/{id}/save', array('as' => 'flight.save', 'uses' => 'FlightsController@save'))
			 ->where(array('id' => '[0-9]+'));

	Route::any('flight/{id}/delete', array('as' => 'flight.delete', 'uses' => 'FlightsController@delete'))
			 ->where(array('id' => '[0-9]+'));

	Route::get('user/{id}/flights', array('as' => 'user.flights', 'uses' => 'FlightsController@saved_flights'))
		   ->where(array('id' => '[0-9]+'));
});




