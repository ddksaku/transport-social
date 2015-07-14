<?php

use Repositories\Flight\FlightRepositoryInterface as Flight;
use Repositories\Carrier\CarrierRepositoryInterface as Carrier;
use Repositories\Airport\AirportRepositoryInterface as Airport;
use Repositories\User\UserRepositoryInterface as User;

class FlightsController extends BaseController {

	protected $flights;
	protected $carriers;
	protected $airports;
	protected $users;

	public function __construct(Flight $flights, Carrier $carriers, Airport $airports, User $users) {
		$this->flights = $flights;
		$this->carriers = $carriers;
		$this->airports = $airports;
		$this->users = $users;
	}

	public function by_airport() {
		if(Request::getMethod() == 'POST') {
			$validation = new Services\Validators\FlightsByAirport;
			return self::get_flight_results($validation, 'by_airport');
		}
		return View::make('flights.by_airport');
	}

	public function by_route() {
		if(Request::getMethod() == 'POST') {
			$validation = new Services\Validators\FlightsByRoute;
			return self::get_flight_results($validation, 'by_route');
		}
		return View::make('flights.by_route');
	}

	public function by_flight_num() {
		if(Request::getMethod() == 'POST') {
			$validation = new Services\Validators\FlightByNumber;
			return self::get_flight_results($validation, 'by_flight_num');
		}
		return View::make('flights.by_flight_num');
	}

	public function get_flight_results($validation, $function_name) {
		if($validation->passes()) {
			$flightStatAPI = new Services\Flightstat\FlightStatus($this->carriers, $this->airports);
			$flights = $flightStatAPI->{$function_name}(Input::all())->flightStatuses;
			$flights = $this->add_variables($flights);
			if(Sentry::check()) {
				$this->saved($flights, false);
			}
			$this->getPassengers($flights);
			$data['no_flights'] = trans('flights.no_flights_found');
			$data['flights'] = $flights;
			return View::make('flights.index', $data);
		}
		return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	public function add_variables($flights) {
		foreach($flights as $flight) {
			$flight->departureTime = $flight->departureDate->dateLocal;
			$flight->arrivalTime = $flight->arrivalDate->dateLocal;
			$flight->id = $flight->flightId;
		}
		return $flights;
	}

	public function saved($flights, $databaseCall) {
		foreach($flights as $flight) {
			if(!$databaseCall) {
				$savedFlight = $this->users->hasFlight($flight->flightId, Sentry::getUser());
				$flight->saved = (!is_null($savedFlight) ? true : false);
			}
			else {
				$flight->saved = true;
			}
		}
		return $flights;
	}

	public function getPassengers($flights, $id = 'flightId') {
		$auth = new Services\Auth;
		foreach($flights as $flight) {
			$flight->passengers = array();
			if($this->flights->find($flight->{$id}) != null) {
				$flight->passengers = $this->flights->getPassengers($flight->{$id}, $auth->getUserInfo());
			}
		}
		return $flights;
	}

	public function privacy($id) {
		$data['flightId'] = $id;
		return View::make('flights.privacy', $data);
	}

	public function saved_flights($id) {
		$flights = $this->users->flights($id);
		$flights = $this->saved($flights, true);
		$flights = $this->getPassengers($flights, 'id');
		$data['no_flights'] = trans('flights.no_saved_flights');
		$data['flights'] = $flights;
		return View::make('flights.index', $data);
	}

	public function save($id) {
		$flight = $this->flights->find($id);
		if(is_null($flight)) {
			$flightStatAPI = new Services\Flightstat\FlightStatus($this->carriers, $this->airports);
			$result = $flightStatAPI->by_flight_id($id)->flightStatus;
			$flightData = array(
				'id' => $result->flightId,
				'number' => $result->flightNumber,
				'arrivalTime' => $result->arrivalDate->dateLocal,
				'departureTime' => $result->departureDate->dateLocal,
			);
			$relationships = array(
				'carrier' => $this->carriers->findByIata($result->carrier->iata),
				'arrivalAirport' => $this->airports->findByIata($result->arrivalAirport->iata),
				'departureAirport' => $this->airports->findByIata($result->departureAirport->iata)
			);
			$flight = $this->flights->create($flightData, $relationships);
		}
		$this->flights->addPassenger($flight->id, Sentry::getUser()->id, Input::get('privacy'));
		return Redirect::route('user.flights', array(Sentry::getUser()->id));
	}

	public function view($id) {
		$flightStatAPI = new Services\Flightstat\FlightStatus($this->carriers, $this->airports);
		$flight = $flightStatAPI->by_flight_id($id);
		$flights = array();
		if(property_exists($flight, 'flightStatus')) {
			$flights[] = $flight->flightStatus;
			$flight = $this->add_variables($flights);
		}
		else {
			$flights[] = $this->flights->find($id);
		}
		$flight = $this->getPassengers($flights);
		$flight = $this->saved($flights, true);
		$data['flight'] = head($flights);
		if(!count($data['flight']) > 0) {
			return Redirect::back()->withErrors(array(trans('flights.not_found')));
		}
		return View::make('flights.view', $data);
	}

	public function delete($id) {
		$user = Sentry::getUser();
		$flight = $this->users->hasFlight($id, $user);
		if(!is_null($flight)) {
			$this->users->deleteFlight($id, $user);
			Session::flash('message', trans('flights.deleted_flight'));
		}
		else {
			Session::flash('message', trans('flights.cannot_delete'));
		}

		return Redirect::route('user.flights', array($user->id));
	}
}
