@extends('theme.layout.layout')

@section('content')
<h2 class="intro-y text-lg font-medium mt-10 font-helvetica">
    მომხმარებელთა ჩამონათვალი
</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <a href="/services/create" class="button text-white bg-theme-1 shadow-md mr-2">დაამატეთ ახალი</a>
        <div class="dropdown relative">
            <button class="dropdown-toggle button px-2 box text-gray-700">
                <span class="w-5 h-5 flex items-center justify-center"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus w-4 h-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> </span>
            </button>
            <div class="dropdown-box mt-10 absolute w-40 top-0 left-0 z-20">
                <div class="dropdown-box__content box p-2">
                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer w-4 h-4 mr-2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> Print </a>
                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text w-4 h-4 mr-2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Export to Excel </a>
                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text w-4 h-4 mr-2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Export to PDF </a>
                </div>
            </div>
        </div>
        <div class="hidden md:block mx-auto text-gray-600">ნაჩვენებია {{$services->count()}} სერვისი</div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-gray-700">
                
               </div>
        </div>
    </div>
    <table class="table table-report -mt-2 col-span-12">
        <thead>
            <tr>
                <th class="whitespace-no-wrap">სათაური</th>
                <th class="whitespace-no-wrap">კატეგორია</th>
                <th class="whitespace-no-wrap">ერთეული</th>
                <th class="whitespace-no-wrap">დრო</th>
                <th class="whitespace-no-wrap">ფოტო</th>
                <th class="text-center whitespace-no-wrap">ფასი</th>
                <th class="text-center whitespace-no-wrap">სტატუსი</th>
                <th class="text-center whitespace-no-wrap ">პრივილეგია</th>
            </tr>
        </thead>
        <tbody>

           @if ($services)
           @foreach ($services as $serv)
                
           <tr class="intro-x">
               <td class="w-40">
                   <div class="flex">
                    {{$serv->title_ge}}
                   </div>
               </td>
               <td>
               @if ($serv->category()->first())
               {{ $serv->category()->first()->{"title_".app()->getLocale()} }}
               @endif
                
               </td>
               <td class="whitespace-no-wrap">
                   {{$serv->unit_ge}}
               </td>
               <td class="whitespace-no-wrap">
                   {{$serv->duration_ge}}
               </td>
               <td class="whitespace-no-wrap">
                   @if ($serv->image)
               <a href="/storage/serviceimg/{{$serv->image->name}}" target="_blank" rel="noopener noreferrer">გახსნა</a>
                   @endif
               </td>
           <td class="text-center">{{$serv->price/100}} ₾</td>
               <td class="w-40">
                   @if ($serv->published)
               <a href="/services/turn/{{$serv->id}}/0" class="bg-red-500 p-3 text-white w-full" >გამორთვა</a>
                   @else
                   <a href="/services/turn/{{$serv->id}}/1"  class="bg-green-500 p-3 text-white w-full">ჩართვა</a>
                   @endif
               </td>
               <td class="table-report__action w-56">
                   <div class="flex justify-center items-center">
                       <a class="flex items-center mr-3" href="services/{{$serv->id}}/edit"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> რედაქტირება </a>
                   <form action="/services/{{$serv->id}}" method="POST">
                           @csrf
                           @method('DELETE')
                           <button class="flex items-center mr-3" type="submit">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> წაშლა
                       </button>
                       </form>
                   </div>
               </td>
           </tr>
           @endforeach
           @if ($services->links())
           <ul class="pagination">
             
            @if ($services->previousPageUrl())
            <li>
                <a class="pagination__link" href="{{$services->url(1)}}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left w-4 h-4"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg> პირველი</a>
            </li>
            <li>
                <a class="pagination__link" href="{{$services->previousPageUrl()}}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left w-4 h-4"><polyline points="15 18 9 12 15 6"></polyline></svg> წინა </a>
            </li>
            @endif
           
               
            <li>
                <a class="pagination__link" href="{{$services->nextPageUrl()}}"> შემდეგი <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right w-4 h-4"><polyline points="9 18 15 12 9 6"></polyline></svg></a>
            </li>
            <li>
                <a class="pagination__link" href="{{$services->url($services->lastPage())}}"> ბოლო <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right w-4 h-4"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg> </a>
            </li>
        </ul>
           @endif
           @endif
            


        </tbody>
    </table>
</div>
@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.side-menu').removeClass('side-menu--active');
		$('.side-menu[data-menu="services"]').addClass('side-menu--active');
        
	});

</script>
@endsection