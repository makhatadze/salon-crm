@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 gap-6 mt-5 flex content-center ">
<div class="intro-y col-span-6 box p-4">
<form method="post" action="{{ route('AddOffice', $company->id) }}">
        @csrf
        <label class="font-helvetica w-full"><b> {{$company->{'title_'.app()->getLocale()} }} | ახალი ოფისის რეგისტრირება</b></label>
        <div class="flex">
            <div class="w-1/2 p-2">
                <label class="font-helvetica">მოკლე სახელი ქართულად <span class="text-red-700">*</span></label>
            <input required type="text" class="input w-full border mt-2"  name="office-name-ge">
            @error('office-name-ge')
            <span class="invalid-feedback" role="alert">
                <strong style="color: tomato">{{ $message }}</strong>
            </span>
            @enderror
            </div>
            <div class="w-1/2 p-2">
                <label class="font-helvetica">მისამართი ქართულად <span class="text-red-700">*</span></label>
            <input required type="text" class="input w-full border mt-2"  name="address-ge">
            @error('address-ge')
            <span class="invalid-feedback" role="alert">
                <strong style="color: tomato">{{ $message }}</strong>
            </span>
            @enderror
            </div>
        </div>
        <div class="flex">
            <div class="w-1/2 p-2">
                <label class="font-helvetica">მოკლე სახელი რუსულად </label>
            <input  type="text" class="input w-full border mt-2"  name="office-name-ru">

            </div>
            <div class="w-1/2 p-2">
                <label class="font-helvetica">მისამართი რუსულად </label>
            <input  type="text" class="input w-full border mt-2"  name="address-ru">

            </div>
        </div>
        <div class="flex">
            <div class="w-1/2 p-2">
                <label class="font-helvetica">მოკლე სახელი ინგლისურად </label>
            <input  type="text" class="input w-full border mt-2"  name="office-name-en">

            </div>
            <div class="w-1/2 p-2">
                <label class="font-helvetica">მისამართი ინგლისურად </label>
            <input  type="text" class="input w-full border mt-2"  name="address-en">
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
        $('.side-menu[data-menu="companies"]').addClass('side-menu--active');
        $('#menucompanies ul').addClass('side-menu__sub-open');
        $('#menucompanies ul').css('display', 'block');
        
	});

</script>
@endsection