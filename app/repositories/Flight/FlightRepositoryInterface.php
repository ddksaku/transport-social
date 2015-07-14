<?php namespace Repositories\Flight;

interface FlightRepositoryInterface {

  public function all();

  public function find($id);

  public function getPassengers($id, $user);

  public function addPassenger($flightId, $userId, $privacy);

  public function create($fields, $relationships);

}