<?php namespace Services\Flightstat;

class FlightStatus extends FlightstatApi {

  private $queries;
  private $carriers;
  private $airports;

  public function __construct($carriers, $airports) {
    parent::__construct('flightstatus');
    $this->airports = $airports;
    $this->carriers = $carriers;
    $this->queries['extendedOptions'] = 'useInlinedReferences';
	}

	public function by_flight_id($id) {
		return $this->api_call('flight/status/'.$id, $this->queries);
	}

	public function by_airport($request) {
    $arrivalAirportCode = $this->airports->findByName($request['arrivalAirportCode'])->airport_code;
    $function = 'airport/status/'.$arrivalAirportCode.'/'.
                $request['direction'].'/'.$this->format_date($request['date']).'/'.$request['hour'];
    return $this->api_call($function, $this->queries);
	}

	public function by_route($request) {
    $arrivalAirportCode = $this->airports->findByName($request['arrivalAirportCode'])->airport_code;
    $departureAirportCode = $this->airports->findByName($request['departureAirportCode'])->airport_code;
    $function = 'route/status/'.$departureAirportCode.'/'.
                $arrivalAirportCode.'/dep/'.$this->format_date($request['date']);

    return $this->api_call($function, $this->queries);
	}

	public function by_flight_num($request) {
    $carrierCode = $this->carriers->findByName($request['carrierCode'])->airline_code;
    $function = 'flight/status/'.$carrierCode.'/'.
                 $request['flightNumber'].'/dep/'.$this->format_date($request['date']);
    return $this->api_call($function, $this->queries);
	}

	public function format_date($date) {
    return date("Y/n/j", strtotime($date));
  }
}