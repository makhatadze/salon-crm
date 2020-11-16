@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 gap-6 mt-5 flex content-center ">
<div class="intro-y col-span-12 md:col-span-6 box p-4">

    <form action="{{route('addDistCompany')}}" method="post">
    
        @csrf
        <h6 class="font-bold w-full mb-3"><b>@lang('adddistributor.register')</b></h6>
        
        <div class="flex flex-wrap -mx-3 mb-1">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="font-bold font-caps text-xs">@lang('adddistributor.name')<span class="text-red-700">*</span></label>
                <input required type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  name="name_ge">
            </div>
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="font-bold font-caps text-xs">@lang('adddistributor.code') <span class="text-red-700">*</span></label>
                <input required type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  name="code">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-1">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="font-bold text-xs font-caps">@lang('adddistributor.phone')</label>
            <input type="text" onkeyup="this.value = this.value.replace(/[^0-9\.]/g, '');" minlength="9" maxlength="9" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  name="phone">
            </div>
            
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="font-bold font-caps text-xs">@lang('adddistributor.address')</label>
                <input  type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="address">
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="font-bold font-caps text-xs">@lang('adddistributor.person')</label>
                <input  type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="contact_to">
            </div>
        </div>
        
    
        <div class="relative mt-3">
            <button type="submit" class="button w-25 bg-theme-1 text-white font-bolder font-caps text-xs">@lang('adddistributor.add')</button>
        </div>
    </form>
</div></div>


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