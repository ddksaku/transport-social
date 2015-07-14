<?php
use Repositories\Airport\AirportRepositoryInterface as Airport;

class AirportController extends BaseController {

	protected $airports;

	public function __construct(Airport $airports) {
		$this->airports = $airports;
	}

	public function suggest() {
		$airports = array();
		$results = $this->airports->suggest(Input::get('term'));
		foreach($results as $result){
      $airports[] = $result->name;
    }
		return json_encode($airports);
	}
}
