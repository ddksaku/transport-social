<?php namespace Repositories\User;

interface UserRepositoryInterface {

  public function all();

  public function find($id);

  public function flights($id);

  public function hasFlight($flightId, $user);

  public function getPhotos($user);

  public function getProfilePic($user);

  public function add_contact($fields);

  public function get_contacts($user);

  public function saveProfilePic($photo, $user);

  public function get_conversations($user);

  public function savePhotos($photos, $user);

  public function deleteFlight($flightId, $user);

  public function suggestFriends($term, $user);

  public function getByName($name);

  public function delete_contact($user, $contactId);

  public function get_pending_contacts($user);

  public function approve_contact($user, $contactId);

  public function hasFriend($user, $userIds);

}