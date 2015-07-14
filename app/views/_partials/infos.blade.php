@if (isset($infos))
	<div class="alert alert-info">
		{{ $infos }}
	</div>
@endif
@if (isset($info_errors))
	<div class="alert alert-danger">
		{{ $info_errors }}
	</div>
@endif