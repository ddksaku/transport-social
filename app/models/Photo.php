<?php

class Photo extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

  public $fillable = array('*');

	public $timestamps = false;

  const PROFILE = 'profile';
  const PHOTO = 'photo';

  protected $hidden = array('imageable_type');

  public function imageable()
  {
    return $this->morphTo();
  }

  public function getPathAttribute($value)
  {
    return json_decode($this->attributes['path']);
  }
}
