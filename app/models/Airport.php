<?php

class Airport extends Eloquent {
	protected $guarded = array();

	protected $fillable = array('*');

	public static $rules = array();

  public function flights() {
    return $this->hasMany('Flight');
  }

  public function scopefindByIata($query, $iata) {
  	return $query->where('airport_code', '=', $iata);
  }
}
