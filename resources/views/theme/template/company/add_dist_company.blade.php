@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 gap-6 mt-5 flex content-center ">
<div class="intro-y col-span-6 box p-4">

    <form action="{{route('addDistCompany')}}" method="post">
    
        @csrf
        <label class="font-helvetica w-full"><b>რეგისტრირება</b></label>
        <div class="w-fill p-2">
            <label class="font-helvetica">კოდი <span class="text-red-700">*</span></label>
        <input required type="text" class="input w-full border mt-2"  name="code">
        </div>
        <div class="flex">
            <div class="w-1/3 p-2">
                <label class="font-helvetica">სახელი ქართულად<span class="text-red-700">*</span></label>
            <input required type="text" class="input w-full border mt-2"  name="name_ge">
            </div>
            
            <div class="w-1/3 p-2">
                <label class="font-helvetica">სახელი რუსულად</label>
                <input  type="text"  class="input w-full border mt-2" name="name_ru">
            </div>
            <div class="w-1/3 p-2">
                <label class="font-helvetica">სახელი ინგლისურად</label>
                <input  type="text"  class="input w-full border mt-2" name="name_en">
            </div>
        </div>
        <div class="flex">
            <div class="w-1/3 p-2">
                <label class="font-helvetica">მობილური</label>
            <input type="text" onkeyup="this.value = this.value.replace(/[^0-9\.]/g, '');" minlength="9" maxlength="9" class="input w-full border mt-2"  name="phone">
            </div>
            
            <div class="w-1/3 p-2">
                <label class="font-helvetica">მისამართი</label>
                <input  type="text" class="input w-full border mt-2" name="address">
            </div>
            <div class="w-1/3 p-2">
                <label class="font-helvetica">საკონტაქტო პირი</label>
                <input  type="text" class="input w-full border mt-2" name="contact_to">
            </div>
        </div>
        
    
        <div class="relative mt-3">
            <button type="submit" class="button w-25 bg-theme-1 text-white font-helvetica">დამატება</button>
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