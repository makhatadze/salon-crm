@extends('theme.layout.layout')

@section('content')
@livewire('service.index')
@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
        $('.side-menu').removeClass('side-menu--active');
        $('.side-menu[data-menu="services"]').addClass('side-menu--active');
        $('#menuservices ul').addClass('side-menu__sub-open');
        $('#menuservices ul').css('display', 'block');
        
	});

</script>
@endsection