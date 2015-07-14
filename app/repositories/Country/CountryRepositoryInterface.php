<?php namespace Repositories\Country;

interface CountryRepositoryInterface {
	public function all();

	public function find($id);

	public function listAll();

}