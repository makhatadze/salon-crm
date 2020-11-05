@extends('theme.layout.layout')

@section('content')

<div class="grid grid-cols-12 gap-6 mt-5">

    <!-- Companies -->
    @if ($companies)
   @foreach ($companies as $company)
   <div class=" col-span-12 lg:col-span-3 box pt-10 border-2 border-theme-1">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield w-12 h-12 text-theme-1 mx-auto"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg> 
    <div class="font-medium text-center text-base mt-3 font-bold">{{$company->title_ge }}</div>
    <div class="text-gray-600 mt-2 w-3/4 text-center mx-auto font-normal text-xs">{!! $company->description_ge  !!}</div>
    @livewire('company.office', ['company' => $company])
    
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