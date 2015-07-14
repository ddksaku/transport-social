@extends('layouts.default')
@section('content')
	@include('_partials.users.sidebar')
	<div class="col-lg-9">		
		@include('_partials.errors')
		{{ Form::open(array('route' => 'user.update_password', 'id' => 'change_password_form'))}}
			<input type="hidden" name="csrf_token" value="" />
			<div class="alert alert-info">
				<p>{{ trans('user_auth.explain_change_password'); }}</p>
			</div>	
			<div class="form-group">
				{{ Form::label('current_password' , trans('user_auth.current_password_label'))}}
				{{ Form::password('current_password', array('class' => 'form-control')) }}
			</div>

			<div class="form-group">
				{{ Form::label('new_password' , trans('user_auth.new_password_label'))}}
				{{ Form::password('new_password' , array('class' => 'form-control')) }}
			</div>

			<div class="form-group">
				{{ Form::label('repeat_password' , trans('user_auth.create_user_password_confirm_label'))}}
				{{ Form::password('repeat_password' , array('class' => 'form-control')) }}
			</div>


		{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
		{{ Form::close() }}
	</div>	
@stop

<?php Asset::container('assets')->add('manageuser', 'js/manageuser.js'); ?>