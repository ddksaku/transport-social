<?php namespace Repositories\Photo;

interface PhotoRepositoryInterface {

  public function all();

  public function find($id);

  public function create($fields);

}