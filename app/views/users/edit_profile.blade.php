@extends('layouts.default')
@section('content')
	@include('_partials.users.sidebar')
	<div class="col-md-6">	
		<div id="required_fields_message">{{ trans('user_auth.create_user_fields_required_message'); }}</div>
		@include('_partials.errors')
		{{ Form::open(array('route' => 'user.edit_profile', 'id' => 'profile_form'))}}
	  	<div class='form-group'>
				{{ Form::label('fname' , trans('user_auth.create_user_fname_label') , array('class'=>'required')); }}
				{{ Form::text('first_name' , $user->first_name , array('class' => 'form-control')); }}
			</div>
	          <div class='form-group required'>
				{{ Form::label('lname' , trans('user_auth.create_user_lname_label') , array('class'=>'required')); }}
				{{ Form::text('last_name' , $user->last_name , array('class' => 'form-control')); }}
			</div>
			<div class='form-group required'>
				{{ Form::label('email' , trans('user_auth.create_user_email_label') , array('class'=>'required')); }}
				{{ Form::text('email' , $user->email , array('class' => 'form-control')); }}
			</div>
	          <div class='form-group'>
	          	{{ Form::label('country' , trans('user_auth.create_user_user_location')); }}
	              {{Form::select('country', $countries , $user->country , array('class' => 'form-control')) }}
	          </div>
	    <div class="form-group">
				{{ Form::label('birthday' , trans('user_auth.create_user_birthday')); }}
				<div class="input-group date" data-date-format="d-m-yyyy">
					{{ Form::text('birthday', $user->birthday , array('class' => 'form-control')) }}
					<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
				</div>
			</div>
			<div class='form-group'>
				{{ Form::label('occupation' , trans('user_auth.create_user_occupation')); }}
				{{ Form::text('occupation' , $user->company , array('class' => 'form-control')); }}
			</div>
			<div class='form-group'>
				{{ Form::label('about_me' , trans('user_auth.create_user_about_me')); }}
				{{ Form::textarea('about_me' , $user->about_me , array('class' => 'form-control' , 'rows' => 7)); }}
			</div>
			<div class='form-group'>
				{{ Form::label('hobbies' , trans('user_auth.create_user_hobbies')); }}
				{{ Form::text('hobbies' , $user->hobbies , array('class' => 'form-control')); }}
			</div>
			<div class='form-group'>
				{{ Form::label('musics' , trans('user_auth.create_user_musics')); }}
				{{ Form::text('musics' , $user->musics , array('class' => 'form-control')); }}
			</div>
			<div class='form-group'>
				{{ Form::label('movies' , trans('user_auth.create_user_movies')); }}
				{{ Form::text('movies' , $user->movies , array('class' => 'form-control')); }}
			</div>
			<div class='form-group'>
				{{ Form::label('books' , trans('user_auth.create_user_books')); }}
				{{ Form::text('books' , $user->books , array('class' => 'form-control')); }}
			</div>
			{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
		{{ Form::close() }}
	</div>	
@stop

@include('_partials.assets.datepicker')