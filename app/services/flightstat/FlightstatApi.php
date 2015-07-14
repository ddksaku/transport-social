<?php namespace Services\Flightstat;

use Guzzle\Http\Client;

abstract class FlightstatApi
{
	private $client;
	protected $config;
	private $type;

	public function __construct($type) {
		$this->type = $type;
		$this->config = array(
      'appId' => 'bf28d4a0',
      'appKey' => 'a7ca1c2a0eab46e9d097f4aa39168ac7'
    );
	}

	public function initialize() {

		$this->client = new Client('https://api.flightstats.com/flex/'.$this->type.'/rest/v2/json/');
	}

	public function api_call($function, $queries = array()) {
		$this->initialize();

		$request = $this->client->get($function, $this->config);
		if(count($queries) > 0) {
			$query = $request->getQuery();
			foreach($queries as $name => $value) {
				$query->add($name, $value);
			}
		}
		$response = $request->send();

		return json_decode (json_encode ($response->json()), FALSE);
	}
}
