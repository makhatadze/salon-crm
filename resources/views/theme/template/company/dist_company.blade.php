@extends('theme.layout.layout')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto font-helvetica">
        @lang('distributor.title')
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
           <a href="/companies/dist/create" type="button" class="button button--lg block text-white bg-theme-1 font-normal mx-auto mt-8"> 
            @lang('distributor.add')
           </a>
    </div>
</div>
            @livewire('distributor.index')

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