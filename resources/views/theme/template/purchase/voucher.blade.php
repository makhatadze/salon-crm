@extends('theme.layout.layout')

@section('content')

@livewire('voucher')
@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
        $('.side-menu').removeClass('side-menu--active');
        $('.side-menu[data-menu="purchases"]').addClass('side-menu--active');
        $('#menupurchases ul').addClass('side-menu__sub-open');
        $('#menupurchases ul').css('display', 'block');
        
	});

</script>
@endsection