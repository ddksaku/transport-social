<?php namespace Repositories\Flight;

use Flight;

class EloquentFlightRepository implements FlightRepositoryInterface {

  public function all()
  {
    return Flight::all();
  }

  public function find($id)
  {
    return Flight::find($id);
  }

  public function getPassengers($id, $user)
  {
    $passengers = $this->find($id)->passengers->filter(function($passenger) use($user)
    {
      if($user->id == $passenger->id) {
        return true;
      }
      if($passenger->pivot->privacy == ONLY_YOU && $user->id == $passenger->id) {
        return true;
      }
      else if(isset($user->id)) {
        if($passenger->pivot->privacy == OTHER_USERS && isset($user->id)) {
          return true;
        }
        else if($passenger->pivot->privacy == ONLY_FRIENDS && $user->hasFriend($passenger->id)) {
          return true;
        }
      }
      else {
        return false;
      }
    });

    return $passengers;
  }

  public function addPassenger($flightId, $userId, $privacy)
  {
  	$passenger = $this->find($flightId)->passengers()->where('user_id', '=', $userId)->first();
    if(is_null($passenger)) {
      $this->find($flightId)->passengers()->sync(array($userId => array('privacy' => $privacy)));
    }
  }

  public function create($fields, $relationships)
  {
		$flight = new Flight;
		$flight->id = $fields['id'];
		$flight->number = $fields['number'];
		$flight->arrivalTime = $fields['arrivalTime'];
		$flight->departureTime = $fields['departureTime'];
		$flight->carrier()->associate($relationships['carrier']);
		$flight->arrivalAirport()->associate($relationships['arrivalAirport']);
		$flight->departureAirport()->associate($relationships['departureAirport']);
		$flight->save();
		return $flight;
  }
}