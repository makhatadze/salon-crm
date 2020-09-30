@extends('theme.layout.layout')
@section('content')


@livewire('warehouse')


@endsection
@section('custom_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.side-menu').removeClass('side-menu--active');
            $('.side-menu[data-menu="products"]').addClass('side-menu--active');
           
        });
    </script>
@endsection
