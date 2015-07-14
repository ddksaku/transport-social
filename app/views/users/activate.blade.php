@extends('layouts.default')
@section('content')
	@if(isset($error))
		<div class="alert alert-danger">
			{{ $error }}
		</div>
	@elseif(isset($success))
		<div class="alert alert-success">
			{{ $success }}
		</div>
	@endif
@stop