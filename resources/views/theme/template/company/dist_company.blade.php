@extends('theme.layout.layout')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto font-helvetica">
        ახალი სადისტრიბუციო კომპანია
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
           <a href="/companies/dist/create" type="button" class="button button--lg block text-white bg-theme-1 font-helvetica mx-auto mt-8"> 
               დამატება
           </a>
    </div>
</div>
<div class="intro-y box overflow-hidden mt-5">
    <div class="px-5 sm:px-16 py-10 sm:py-20">
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th class="border-b-2 whitespace-no-wrap font-helvetica">სახელი</th>
                        <th class="border-b-2 text-right whitespace-no-wrap font-helvetica">მოქმედება</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($distcompanies as $company)
                    <tr>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap font-helvetica">{{$company->{'name_'.app()->getLocale()} }}</div>
                        <div class="text-gray-600 text-xs whitespace-no-wrap font-helvetica">{{$company->code}}</div>
                        </td>
                        <td class="text-right border-b w-56 font-medium font-helvetica">
                        <a href="/companies/dist/edit/{{$company->id}}" class="text-yellow-500">რედაქტირება</a> | <a href="/companies/dist/remove/{{$company->id}}" class="text-red-400">წაშლა</a>
                        </td>
                    </tr>
                    @endforeach
                   
                </tbody>
            </table>
        </div>
    </div>
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