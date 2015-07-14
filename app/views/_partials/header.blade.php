@section("header")
  <nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    {{ link_to_route('site.home', 'Transport Social', null, array('class' => 'navbar-brand')) }}
  </div>

  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Search Flights<b class="caret"></b></a>
        <ul class="dropdown-menu">
          {{ HTML::clever_link('flights.by_airport', 'By Airport') }}
          {{ HTML::clever_link('flights.by_route', 'By Route') }}
          {{ HTML::clever_link('flights.by_flight_num', 'By Flight') }}
        </ul>
      </li>

      @if(Sentry::check())
        {{ HTML::clever_link('user.flights', 'Saved Flights', array(Sentry::getUser()->id)) }}
        {{ HTML::clever_link('messages.inbox', 'Messages') }}
        {{ HTML::clever_link('user.profile', 'My Profile', array(Sentry::getUser()->id)) }}
        {{ HTML::clever_link('users.logout', 'Logout') }}
      @else
        {{ HTML::clever_link('users.login', 'Login') }}
      @endif
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>
@show