@extends('layouts.default')
@section('content')
	@include('_partials.errors')
	{{ Form::open(array('route' => 'users.register', 'id' => 'customer_form'))}}
		<input type="hidden" name="csrf_token" value="" />
		<div class="form-group">
			{{ Form::label('first_name' , trans('user_auth.create_user_fname_label'))}}
			{{ Form::text('first_name', null, array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('last_name' , trans('user_auth.create_user_lname_label'))}}
			{{ Form::text('last_name', null, array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('email' , trans('user_auth.create_user_email_label'))}}
			{{ Form::text('email', null, array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('password' , trans('user_auth.create_user_password_label'))}}
			{{ Form::password('password' , array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('repeat_password' , trans('user_auth.create_user_password_confirm_label'))}}
			{{ Form::password('repeat_password' , array('class' => 'form-control')) }}
		</div>
	{{ Form::submit('Register', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop

<?php Asset::container('assets')->add('manageuser', 'js/manageuser.js'); ?>