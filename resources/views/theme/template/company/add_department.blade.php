@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 gap-6 mt-5 flex content-center ">
<div class="intro-y col-span-6 box p-4">

    <form action="{{route('AddDepartment')}}" method="post">
        @csrf
        <label class="font-helvetica w-full"><b>ოფისის რეგისტრირება</b></label>
        <div class="flex">
            <div class="w-1/2 p-2">
                <label class="font-bold font-caps text-xs text-gray-700">მოკლე სახელი ქართულად <span class="text-red-700">*</span></label>
            <input required type="text" class="input w-full border mt-2"  name="department-name-ge">
            @error('department-name-ge')
            <span class="invalid-feedback" role="alert">
                <strong style="color: tomato">{{ $message }}</strong>
            </span>
        @enderror
            </div>
            
            <div class="w-1/2 p-2">
                <label class="font-bold font-caps text-xs text-gray-700">მისამართი ქართულად <span class="text-red-700">*</span></label>
                <input required type="text" class="input w-full border mt-2" name="address-ge">
                @error('address-ge')
            <span class="invalid-feedback" role="alert">
                <strong style="color: tomato">{{ $message }}</strong>
            </span>
                @enderror
            </div>
        </div>
        
        <small class="w-full font-normal m-2">რომ შეიქმნას დეპარტამენტის სახელი სხვა ენაზე, საჭიროა შეავსოთ ორივე ველი</small>
        <br>
        <div class="flex">
            <div class="w-1/2 p-2">
                <label class="font-bold font-caps text-xs text-gray-700">მოკლე სახელი რუსულად</label>
            <input  type="text" class="input w-full border mt-2" name="department-name-ru">
            </div>
            
            <div class="w-1/2 p-2">
                <label class="font-bold font-caps text-xs text-gray-700">მისამართი რუსულად</label>
                <input  type="text"  class="input w-full border mt-2" name="address-ru">
            </div>
        </div>
        
        <div class="flex">
            <div class="w-1/2 p-2">
                <label class="font-bold font-caps text-xs text-gray-700">მოკლე სახელი ინგლისურად</label>
            <input  type="text" class="input w-full border mt-2" name="department-name-en">
            </div>
            
            <div class="w-1/2 p-2">
                <label class="font-bold font-caps text-xs text-gray-700">მისამართი ინგლისურად</label>
                <input  type="text" class="input w-full border mt-2" name="address-en">
            </div>
        </div>
        <div class="mt-2">
            <label class="font-bold font-caps text-xs text-gray-700">აირჩიეთ კომპანიის ოფისი <span class="text-red-700">*</span></label><br>
            <select required class="input border mr-2 w-full" name="office-id">
                @foreach ($companies as $company)
                    @foreach($company->offices()->whereNull('deleted_at')->get() as $office)
                    <option value="{{$office->id}}">{{$company->{"title_".app()->getLocale()} }} | {{$office->{"name_".app()->getLocale()} }}</option>
                    @endforeach
                @endforeach
            </select>
        </div>
        <div class="relative mt-3">
            <button type="submit" class="button w-25 bg-theme-1 text-white font-bold font-caps text-xs">დამატება</button>
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