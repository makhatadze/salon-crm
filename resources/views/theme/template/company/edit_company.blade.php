@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 gap-6 mt-5 flex content-center ">
<div class="intro-y col-span-6 box p-4">
    <form action="{{route('EditCompany', $company->id)}}" method="post">
    @method('PUT')
        @csrf
        <label class="font-helvetica w-full"><b>ოფისის რეგისტრირება</b></label>
        <div class="flex">
            <div class="w-1/2 p-2">
                <label class="font-helvetica">მოკლე სახელი <span class="text-red-700">*</span></label>
            <input required type="text" class="input w-full border mt-2" value="{{$company->offices()->first()->name_ge}}" name="office-name-ge">
            </div>
            
            <div class="w-1/2 p-2">
                <label class="font-helvetica">მისამართი <span class="text-red-700">*</span></label>
                <input required type="text"  value="{{$company->offices()->first()->address_ge}}"class="input w-full border mt-2" name="address-ge">
            </div>
        </div>
        <div class="flex">
            <div class="w-1/2 p-2">
                <label class="font-helvetica">მოკლე სახელი რუსულად</label>
            <input  type="text" class="input w-full border mt-2"value="{{$company->offices()->first()->name_ru}}"  name="office-name-ru">
            </div>
            
            <div class="w-1/2 p-2">
                <label class="font-helvetica">მისამართი რუსულად</label>
                <input  type="text"  value="{{$company->offices()->first()->address_ru}}" class="input w-full border mt-2" name="address-ru">
            </div>
        </div>
        <div class="flex">
            <div class="w-1/2 p-2">
                <label class="font-helvetica">მოკლე სახელი ინგლისურად </label>
            <input  type="text" class="input w-full border mt-2" value="{{$company->offices()->first()->name_en}}" name="office-name-en">
            </div>
            
            <div class="w-1/2 p-2">
                <label class="font-helvetica">მისამართი ინგლისურად</label>
                <input  type="text"  value="{{$company->offices()->first()->address_en}}"  class="input w-full border mt-2" name="address-en">
            </div>
        </div>
    
        <label class="font-helvetica"><b>კომპანიის ინფორმაცია </b></label>
        <div class="flex">
            <div class="w-1/3 p-2">
                <label class="font-helvetica">სახელი ქართულად <span class="text-red-700">*</span></label>
                <input required type="text"  value="{{$company->title_ge}}"  class="input w-full border mt-2" name="title-ge">
            </div>
            <div class="w-1/3 p-2">
                <label class="font-helvetica">სახელი ინგლისურად</label>
                <input type="text" class="input w-full border mt-2"  value="{{$company->title_en}}"  name="title-en">
            </div>
            <div class="w-1/3 p-2">
                <label class="font-helvetica">სახელი რუსულად</label>
                <input type="text" class="input w-full border mt-2" name="title-ru" value="{{$company->title_ru}}" >
            </div>
        </div>
        <div class="mt-3">
            <label class="font-helvetica">აღწერა ქართულად <span class="text-red-700">*</span></label>
            <div class="mt-2">
                <textarea required data-feature="basic" class="summernote" name="editor-ge">
                    {{$company->description_ge}} 
                </textarea>
            </div>
        </div>
        <div class="mt-3">
            <label class="font-helvetica">აღწერა რუსულად</label>
            <div class="mt-2">
                <textarea data-feature="basic" class="summernote" name="editor-ru">
                     {{$company->description_ru}} 
                </textarea>
            </div>
        </div>
        <div class="mt-3">
            <label class="font-helvetica">აღწერა ინგლისურად</label>
            <div class="mt-2">
                <textarea data-feature="basic" class="summernote" name="editor-en">
                     {{$company->description_en}} 
                </textarea>
            </div>
        </div>
    
        <div class="relative mt-3">
            <button type="submit" name="user_add_submit" class="button w-25 bg-theme-1 text-white font-helvetica">განახლება</button>
        </div>
    </form>
</div></div>


@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.side-menu').removeClass('side-menu--active');
		$('.side-menu[data-menu="companies"]').addClass('side-menu--active');
        
	});

</script>
@endsection