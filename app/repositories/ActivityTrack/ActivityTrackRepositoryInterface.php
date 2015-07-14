<?php namespace Repositories\ActivityTrack;

interface ActivityTrackRepositoryInterface {
	public function all();

	public function find($id);

	//public function addTrack($description);
}