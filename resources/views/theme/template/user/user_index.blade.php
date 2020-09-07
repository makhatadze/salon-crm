@extends('theme.layout.layout')

@section('content')
<h2 class="intro-y text-lg font-medium mt-10 font-helvetica">
    მომხმარებელთა ჩამონათვალი
</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <a href="{{ route('ActionUserAdd') }}" class="button text-white bg-theme-1 shadow-md mr-2 font-helvetica">ახალი მომხმარებლის რეგისტრაცია</a>
        <div class="hidden md:block mx-auto text-gray-600"></div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-gray-700">
                <input type="text" class="input w-56 box pr-10 placeholder-theme-13 font-helvetica" placeholder="ძებნა...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i> 
            </div>
        </div>
    </div>
    <div class="intro-y col-span-12 md:col-span-6">
        <div class="box">
            <div class="flex flex-col lg:flex-row items-center p-5">
                <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                    <img alt="" class="rounded-full" src="dist/images/profile-5.jpg">
                </div>
                <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                    <a href="" class="font-medium font-helvetica">Kevin Spacey</a> 
                </div>
                <div class="flex mt-4 lg:mt-0">
                    <a href="#" class="button button--sm text-gray-700 border border-gray-300 font-helvetica">პროფილი</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.side-menu').removeClass('side-menu--active');
		$('.side-menu[data-menu="user"]').addClass('side-menu--active');
	});
</script>
@endsection