@extends('layouts.default')

@section('content')
	<div class="row">
		@include('_partials.messages.sidebar')
		<div class="col-md-9" role="main">
			@if(count($user->conversations) > 0)
				<ul class="list-group">
				@foreach($user->conversations as $conversation)
					<a class="list-group-item" href="{{ route('conversation.view', array($conversation->id))}}">
						<p>{{ $conversation->name }}</p>
						@foreach($conversation->users as $user)
							@if($user->profilePicture['path'] != '')
								<img src="{{ $user->profilePicture->path->thumb }}" width="20" height="20" />
							@else
								<img src="{{ DEFAULT_PROFILE_IMG }}" width="20" height="20" />
							@endif
						@endforeach
					</a>
				@endforeach
				</ul>
			@else
				<div class="alert alert-info">
					{{ trans('messages.instruction_for_starting_conversation')}}
				</div>
			@endif
		</div>
	</div>
@stop