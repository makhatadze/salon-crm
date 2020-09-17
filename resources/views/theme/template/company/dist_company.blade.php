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
                        <th class="border-b-2 whitespace-no-wrap font-bold font-caps">სახელი</th>
                        <th class="border-b-2 text-right whitespace-no-wrap font-bold font-caps">მოქმედება</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($distcompanies as $company)
                    <tr>
                        <td class="border-b">
                            <div class="font-medium whitespace-no-wrap font-helvetica">{{$company->{'name_'.app()->getLocale()} }}</div>
                        <div class="text-gray-600 text-xs whitespace-no-wrap font-helvetica">{{$company->code}}</div>
                        </td>
                        <td class="text-right border-b w-56  font-medium font-helvetica">
                            <div class="flex items-center justify-center w-full">
                        <a href="/companies/dist/edit/{{$company->id}}" class="p-2 bg-gray-300 rounded-lg">
                            <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                              </svg>
                            </a>
                        <a href="/companies/dist/remove/{{$company->id}}" class="p-2 bg-gray-300 rounded-lg ml-2">
                            <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-pip" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 3.5A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5v-9zM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
                                <path d="M8 8.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5v-3z"/>
                              </svg>
                            </a>
                            </div>
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