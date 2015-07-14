<?php

Route::post('carriers/suggest' , array('as' => 'carriers.suggest' , 'uses' => 'CarrierController@suggest'));