@extends('theme.layout.layout')

@section('content')

@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.side-menu').removeClass('side-menu--active');
		$('.side-menu[data-menu="user"]').addClass('side-menu--active');
	});
</script>
@endsection
