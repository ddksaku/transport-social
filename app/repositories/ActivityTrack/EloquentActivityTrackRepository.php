<?php namespace Repositories\ActivityTrack;
use ActivityTrack;
class EloquentActivityTrackRepository implements ActivityTrackRepositoryInterface {
	
	public function all()
	{
		return ActivityTrack::all();
	}

	public function find($id)
	{
		return ActivityTrack::find($id);
	}
}