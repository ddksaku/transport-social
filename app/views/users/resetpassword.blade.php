@extends('layouts.default')
@section('content')
	@include('_partials.errors')
	{{ Form::open(array('route' => 'users.resetpassword', 'id' => 'resetpassword_form'))}}
		<input type="hidden" name="csrf_token" value="" />
		<div class="form-group">
			<p class="content">{{ trans('user_auth.explain_reset_password'); }}</p>
		</div>	
		<div class="form-group">
			{{ Form::label('email' , trans('user_auth.create_user_email_label'))}}
			{{ Form::text('email', null, array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('password' , trans('user_auth.new_password_label'))}}
			{{ Form::password('password' , array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('repeat_password' , trans('user_auth.create_user_password_confirm_label'))}}
			{{ Form::password('repeat_password' , array('class' => 'form-control')) }}
		</div>

	{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
@stop

<?php Asset::container('assets')->add('manageuser', 'js/manageuser.js'); ?>