@extends('theme.layout.layout')

@section('content')
   @livewire('company.finances')
@endsection

@section('custom_scripts')
<script type="text/javascript">
 $(document).ready(function(){
    $('.side-menu').removeClass('side-menu--active');
    $('.side-menu[data-menu="bugalteria"]').addClass('side-menu--active');
    $('#menubugalteria ul').addClass('side-menu__sub-open');
    $('#menubugalteria ul').css('display', 'block');
 });
</script>
@endsection