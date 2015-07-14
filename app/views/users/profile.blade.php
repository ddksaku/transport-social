@extends('layouts.default')

<?php
	Asset::container('assets')->add('modalJS','js/modal.js');
	Asset::container('assets')->add('manageuserJS','js/manageuser.js');
	Asset::container('assets')->add('multifileJS','js/multifile.js');

	Asset::container('assets')->add('fileuploadCSS','css/jquery.fileupload.css');
	Asset::container('assets')->add('fileuploadUICSS','css/jquery.fileupload-ui.css');

	Asset::container('assets')->add('fancyboxJS', 'js/jquery.fancybox.js');
	Asset::container('assets')->add('fancyboxCSS', 'css/jquery.fancybox.css');
	Asset::container('assets')->add('lightboxJS', 'js/lightbox.js');
?>

@section('content')
	@include('_partials.users.sidebar')
	<div>
		<h1>{{$user->first_name." ".$user->last_name;}}</h1>
		@if(!empty($user->company))
			<div class="occupation">
				<p>{{ $user->company. ' | ' .$country->name; }}</p>
			</div>
		@endif
		<div class="btn-group">
			@if($isUser)
				{{ link_to_route('user.edit_profile', 'Edit Profile', null, array('class' => 'btn btn-primary')) }}
				{{ link_to_route('user.add_photo', 'Add Photos', null, array('class' => 'btn btn-primary' , 'data-toggle' => 'modal' , 'data-target' => '#upload_photo_dialog' , 'data-remote' => 'false')) }}
			@endif
		</div>
	</div>
	<br>
	@if (isset($photos) && count($photos) > 0)
	<h4 class="heading">{{ trans('user_auth.my_profile_my_photos'); }}</h4>
		@foreach ($photos as $photo)
			<a class="fancybox" rel="gallery1" href="{{ $photo->path->medium }}">
				{{ HTML::image($photo->path->thumb , null , array('class' => 'thumb img-thumbnail')) }}
			</a>
		@endforeach
	@endif

	@if(!empty($user->about_me))
		<h4 class="heading">{{ trans('user_auth.my_profile_about_me'); }}</h4>
		<p class="content">{{ $user->about_me; }}</p>
	@endif

	@if(!empty($user->hobbies))
		<h4 class="heading">{{ trans('user_auth.my_profile_hobbies'); }}</h4>
		<p class="content">{{ $user->hobbies; }}</p>
	@endif

	@if(!empty($user->musics))
		<h4 class="heading">{{ trans('user_auth.my_profile_musics'); }}</h4>
		<p class="content">{{ $user->musics; }}</p>
	@endif

	@if(!empty($user->movies))
		<h4 class="heading">{{ trans('user_auth.my_profile_movies'); }}</h4>
		<p class="content">{{ $user->movies; }}</p>
	@endif
	@if(!empty($user->books))
		<h4 class="heading">{{ trans('user_auth.my_profile_books'); }}</h4>
		<p class="content">{{ $user->books; }}</p>
	@endif

@include('users.profile_pic')
@stop