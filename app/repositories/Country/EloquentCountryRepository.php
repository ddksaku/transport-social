<?php namespace Repositories\Country;

use Country;

class EloquentCountryRepository implements CountryRepositoryInterface {
	public function all()
	{
		return Country::all();
	}

	public function find($id)
	{
		return Country::find($id);
	}

	public function listAll() {
		return Country::lists('name', 'code');
	}

	public function findByCode($country_code) {
		return Country::where('code' , '=', $country_code)->first();
	}

}
