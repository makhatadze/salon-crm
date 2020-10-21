@extends('theme.layout.layout')

@section('content')

<div class="grid grid-cols-12 gap-6 mt-5">

    <!-- Companies -->
    @if ($companies)
   @foreach ($companies as $company)
   <div class="intro-y col-span-12 lg:col-span-3 box pt-10 border-2 border-theme-1">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield w-12 h-12 text-theme-1 mx-auto"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg> 
    <div class="font-medium text-center text-base mt-3 font-bold">{{$company->{"title_".app()->getLocale()} }}</div>
    <div class="text-gray-600 mt-2 w-3/4 text-center mx-auto font-normal text-xs">{!! $company->{"description_".app()->getLocale()}  !!}</div>
    <div class="flex mt-2">
        <div class="font-bold bg-green-400 py-2 text-center text-xs fotn-caps w-1/2">
            <a href="companies/addoffice/{{$company->id}}">ოფისის დამატება</a>
        </div>
        <div class="font-bold bg-green-400 py-2 text-center text-xs fotn-caps w-1/2">
            <a href="companies/{{$company->id}}/edit">რედაქტირება</a>
        </div>
    </div>
    @foreach ($company->offices as $office)
    <div class="flex bg-gray-200 w-full py-3 px-4">
        <div class="text-center font-medium text-gray-800 text-xs fotn-caps w-1/2">
            <a href="companies/addoffice/{{$company->id}}">
                <h4 class="w-full font-bold text-xs">{{$office->{"name_".app()->getLocale()} }}</h4>
                <small class="font-normal">{{ $office->{"address_".app()->getLocale()} }}</small>
            </a>
        </div>
        <div class="font-normal text-center text-xs fotn-caps w-1/2">
            <div class="mb-3">
                <span class="font-bolder">დეპარტამენტები <small>{{$office->departments()->count()}}</small></span>
            </div>
            @foreach ($office->departments as $dept)
                <div class="mt-3">
                    <span>{{$dept->{"name_".app()->getLocale()} }}</span>
                </div>
            @endforeach
        </div>
    </div>
    @endforeach
    
   </div>
   @endforeach
    @endif
   

</div>
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