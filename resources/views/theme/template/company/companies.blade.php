@extends('theme.layout.layout')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto font-helvetica">
        ახალი კომპანია
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
           <a href="/companies/create" type="button" class="button button--lg block text-white bg-theme-1 font-helvetica mx-auto mt-8"> 
               დამატება
           </a>
    </div>
</div>
<div class="intro-y box flex flex-col lg:flex-row mt-5">

    <!-- Companies -->
    @if ($companies)
   @foreach ($companies as $company)
   <div class="intro-y flex-1 px-5 py-16">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card w-12 h-12 text-theme-1 mx-auto"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg> 
    <div class="text-xl font-helvetica text-center mt-10 "><b>{{$company->{"title_".app()->getLocale()} }}</b></div>
    <div class="text-gray-700 text-center mt-5 font-helvetica"> {{$company->offices()->first()->{"name_".app()->getLocale()} }} | {{$company->offices()->first()->{"address_".app()->getLocale()} }} </div>
    <div class="text-gray-600 px-10 text-center mx-auto mt-2">{!! $company->{"description_".app()->getLocale()} !!}</div>
    <div class="flex grid text-center">
    <a href="companies/addoffice/{{$company->id}}" class="w-full button  text-white bg-green-500 rounded-2 mt-4 font-helvetica">ოფისის დამატება</a>
        <a href="companies/{{$company->id}}/edit" class="w-full button  text-white bg-blue-700 rounded-2 mt-4 font-helvetica">რედაქტირება</a>
    <form action="/companies/{{$company->id}}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="button w-full text-white bg-red-500 rounded-2 mt-4 font-helvetica">წაშლა</button>
        </form>
    </div>
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
        
	});

</script>
@endsection