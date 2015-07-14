<?php namespace Repositories\User;

use Sentry;
use User;
use DB;
use Conversation;

class EloquentUserRepository implements UserRepositoryInterface {

  public function all()
  {
    return Sentry::all();
  }

  public function find($id)
  {
    return Sentry::find($id);
  }

  public function flights($id)
  {
  	return Sentry::find($id)->flights()->get();
  }

  public function hasFlight($flightId, $user)
  {
  	return $user->flights()->where('flight_id', '=', $flightId)->first();
  }

  public function getPhotos($user)
  {
    return $user->photos()->get();
  }

  public function getProfilePic($user) {
    return $user->profilePicture()->first();
  }

  public function saveProfilePic($photo, $user) {
    $photo->type = $photo::PROFILE;
    $photo->save();
    $oldPhoto = $user->profilePicture()->first();
    if($oldPhoto != null) {
      $oldPhoto->type = $oldPhoto::PHOTO;
      $oldPhoto->save();
    }
    $user->profilePicture()->save($photo);

  }

  public function savePhotos($photos, $user) {
    foreach($photos as $photo) {
      $photo->type = $photo::PHOTO;
      $photo->save();
      $user->photos()->save($photo);
    }
  }

  public function add_contact($fields) {
    $user = Sentry::find($fields['user_id']);
    $this->find($fields['contact_id'])->contacts()->attach($user->id,
      array(
        'status' => $fields['contact_status']
      )
    );
  }

  public function get_contacts($user) {
    return $user->contacts()->where('status', '=', APPROVED)->get();
  }

  public function get_conversations($user) {
    return $user->conversations()->get();
  }

  public function deleteFlight($flightId, $user) {
    $user->flights()->detach($flightId);
  }

  public function suggestFriends($term, $user) {
    $users = $user->contacts()->whereNotIn('status', array(1, 2))->get();
    $userIds = array();
    $userIds[] = $user->id;
    foreach($users as $user) {
      $userIds[] = $user->id;
    }
    return User::where(DB::raw('CONCAT(first_name, " ", last_name)'), 'LIKE', "%$term%")->whereNotIn('id', $userIds)->get();
  }

  public function getByName($name) {
    return User::where(DB::raw('CONCAT(first_name, " ", last_name)'), '=', $name)->first();
  }

  public function delete_contact($user, $contactId) {
    $user->contacts()->detach($contactId);
    $this->find($contactId)->contacts()->detach($user->id);
    $ids = array($user->id, (int)$contactId);
    $myConversations = $user->conversations()->get();
    foreach($myConversations as $conversation) {
      $userIds = $conversation->users()->lists('user_id');
      if($ids === $userIds) {
        Conversation::destroy($conversation->id);
      }
    }
  }

  public function get_pending_contacts($user) {
    return $user->contacts()->where('status', '=', PENDING)->get();
  }

  public function approve_contact($user, $contactId) {
    $contact = $user->contacts()->where('contact_id', $contactId)->first();
    $contact->pivot->status = APPROVED;

    $this->find($contactId)->contacts()->attach($user->id,
      array(
        'status' => $contact->pivot->status
      )
    );

    $contact->pivot->save();
  }

  public function hasFriend($user, $userIds) {
    return $user->hasFriend($userIds);
  }
}