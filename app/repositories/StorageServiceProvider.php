<?php namespace Repositories;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->app->bind(
      'Repositories\Flight\FlightRepositoryInterface',
      'Repositories\Flight\EloquentFlightRepository'
    );
    $this->app->bind(
      'Repositories\Carrier\CarrierRepositoryInterface',
      'Repositories\Carrier\EloquentCarrierRepository'
    );
    $this->app->bind(
      'Repositories\Airport\AirportRepositoryInterface',
      'Repositories\Airport\EloquentAirportRepository'
    );
    $this->app->bind(
      'Repositories\User\UserRepositoryInterface',
      'Repositories\User\EloquentUserRepository'
    );
    $this->app->bind(
      'Repositories\Photo\PhotoRepositoryInterface',
      'Repositories\Photo\EloquentPhotoRepository'
    );
    $this->app->bind(
      'Repositories\Message\MessageRepositoryInterface',
      'Repositories\Message\EloquentMessageRepository'
    );
    $this->app->bind(
      'Repositories\Conversation\ConversationRepositoryInterface',
      'Repositories\Conversation\EloquentConversationRepository'
    );
    $this->app->bind(
      'Repositories\Country\CountryRepositoryInterface',
      'Repositories\Country\EloquentCountryRepository'
    );
  }

}