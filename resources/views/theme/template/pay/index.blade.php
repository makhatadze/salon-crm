@extends('theme.layout.layout')
@section('content')
@livewire('paymethods')
@endsection
@section('custom_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
    $('.side-menu').removeClass('side-menu--active');
    $('.side-menu[data-menu="shop"]').addClass('side-menu--active');
    $('#menushop ul').addClass('side-menu__sub-open');
    $('#menushop ul').css('display', 'block');

        });

    </script>
@endsection