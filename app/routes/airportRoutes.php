<?php

Route::post('airports/suggest' , array('as' => 'airports.suggest' , 'uses' => 'AirportController@suggest'));