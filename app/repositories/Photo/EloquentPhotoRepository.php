<?php namespace Repositories\Photo;

use Photo;

class EloquentPhotoRepository implements PhotoRepositoryInterface {

  public function all()
  {
    return Photo::all();
  }

  public function find($id)
  {
    return Photo::find($id);
  }

  public function create($fields)
  {
    $photo = new Photo;
    $photo->path = $fields['path'];
    $photo->save();
    return $photo;
  }
}