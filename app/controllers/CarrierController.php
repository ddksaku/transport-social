<?php
use Repositories\Carrier\CarrierRepositoryInterface as Carrier;

class CarrierController extends BaseController {

	protected $carriers;

	public function __construct(Carrier $carriers) {
		$this->carriers = $carriers;
	}

	public function suggest() {
		$carriers = array();
		$results = $this->carriers->suggest(Input::get('term'));
		foreach($results as $result){
      $carriers[] = $result->name;
    }
		return json_encode($carriers);
	}
}
