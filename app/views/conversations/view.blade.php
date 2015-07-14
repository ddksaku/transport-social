@extends('layouts.default')
@section('content')
	<div class="row">
		@include('_partials.messages.sidebar')
		<div class="col-md-9" role="main">
			@if(count($conversation->messages) > 0)
				<ul class="list-group">
					@foreach($conversation->messages as $message)
						<li class="list-group-item">
							<span>{{ $message->message.' - '.$message->user->name }}</span>
						</li>
					@endforeach
				</ul>
			@endif
			{{ Form::open(array('route' => array('message.send', $conversation->id))) }}
			<div class="input-group">
				{{ Form::text('message' , null , array('class' => 'form-control', 'placeholder' => 'Enter message...')) }}
				<span class="input-group-btn">
        	{{ Form::submit('Send' , array('class' => 'btn btn-primary')) }}
      </span>
			</div>
			{{ Form::close() }}
		</div>
	</div>
@stop

