@extends('layouts.default')
@section('content')
	@include('_partials.errors')
	@include('_partials.infos')
	{{ Form::open(array('route' => 'users.auth', 'id' => 'login_form'))}}
	<div class="form-group">
		<label for="email">Email</label>
		{{ Form::text('email', null, array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		{{ Form::password('password', array('class' => 'form-control')) }}
	</div>
	{{ Form::submit('Login', array('class' => 'btn btn-primary')) }}
	{{ link_to_route('users.register', 'Register', null, array('class' => 'btn btn-primary')) }}
	{{ link_to_route('users.resetpasswordForm', trans('user_auth.link_to_reset_password') , null, array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop