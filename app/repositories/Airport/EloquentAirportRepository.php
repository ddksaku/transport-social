<?php namespace Repositories\Airport;

use Airport;

class EloquentAirportRepository implements AirportRepositoryInterface {

  public function all()
  {
    return Airport::all();
  }

  public function find($id)
  {
    return Airport::find($id);
  }

  public function findByIata($iata)
  {
  	return Airport::where('airport_code', '=', $iata)->first();
  }

  public function findByName($name) {
    return Airport::where('name', '=', $name)->first();
  }

  public function suggest($term) {
    return Airport::where('name', 'like', '%'.$term.'%')
                    ->orWhere('airport_code', 'like', '%'.$term.'%')
                    ->get(array('name', 'id'));
  }
}