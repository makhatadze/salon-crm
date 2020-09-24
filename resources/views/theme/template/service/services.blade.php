@extends('theme.layout.layout')

@section('content')
<h2 class="intro-y text-lg font-medium mt-10 font-helvetica">
    მომხმარებელთა ჩამონათვალი
</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <a href="/services/create" class="button text-white bg-theme-1 shadow-md mr-2 font-bold font-caps text-xs">დაამატეთ ახალი</a>
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
    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
    <table class="table table-report -mt-2 col-span-12">
        <thead>
            <tr>
                <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">სათაური</th>
                <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">კატეგორია</th>
                <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">ერთეული</th>
                <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">დრო</th>
                <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">ფოტო</th>
                <th class="text-center whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">ფასი</th>
                <th class="text-center whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">სტატუსი</th>
                <th class="text-center whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">პრივილეგია</th>
            </tr>
        </thead>
        <tbody>

           @if ($services)
           @foreach ($services as $serv)
           <tr class="intro-x">
               <td class="w-40">
                   <div class="flex font-bold font-black font-caps">
                    {{$serv->{"title_".app()->getLocale()} }}
                   </div>
               </td>
               <td class="font-normal">
               @if ($serv->category)
               {{ $serv->category->{"title_".app()->getLocale()} }}
               @endif
                
               </td>
               <td class="whitespace-no-wrap font-normal">
                   {{$serv->{"unit_".app()->getLocale()} }}
               </td>
               <td class="whitespace-no-wrap font-normal">
                   {{$serv->duration_count }}
                   @if ($serv->duration_type == "minute")
                       წუთი
                   @elseif ($serv->duration_type == "hours")
                       საათი
                   @elseif ($serv->duration_type == "day")
                       დღე
                   @endif
               </td>
               <td class="whitespace-no-wrap">
                   @if ($serv->image)
               <a href="/storage/serviceimg/{{$serv->image->name}}" target="_blank" rel="noopener noreferrer" class="font-bold font-caps text-xs text-indigo-500 ">გახსნა</a>
                   @endif
               </td>
           <td class="text-center font-normal font-caps">{{$serv->price/100}} ₾</td>
               <td class="w-40 font-bold font-caps text-xs">
                   @if ($serv->published)
               <a href="/services/turn/{{$serv->id}}/0" class="p-3 text-red-500 w-full" >გამორთვა</a>
                   @else
                   <a href="/services/turn/{{$serv->id}}/1"  class=" p-3 text-green-500 w-full">ჩართვა</a>
                   @endif
               </td>
               <td class="table-report__action w-56">
                   <div class="flex justify-center items-center font-bold">
                       <a class="p-2 bg-gray-300 rounded-lg ml-2" href="services/{{$serv->id}}/edit"> 
                        <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg>
                        </a>
                   <form action="{{route('RemoveService', $serv->id)}}" method="POST">
                           @csrf
                           @method('DELETE')
                           <button class="p-2 bg-gray-300 rounded-lg ml-2" type="submit">
                            <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-trash2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3.18 4l1.528 9.164a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836L12.82 4H3.18zm.541 9.329A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671L14 3H2l1.721 10.329z"/>
                                <path d="M14 3c0 1.105-2.686 2-6 2s-6-.895-6-2 2.686-2 6-2 6 .895 6 2z"/>
                                <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                              </svg>  
                        </button>
                       </form>
                   </div>
               </td>
           </tr>
           @endforeach
           {{$services->links('vendor.pagination.custom')}}
           @endif
            


        </tbody>
    </table>
    </div>
    <div class="col-span-12 xxl:col-span-3 -mb-10 pb-10 px-4">
        <h6 class="font-bold font-caps text-gray-700 text-xs mt-4">
            ფილტრი
        </h6>
        <div class="box mt-5 p-3">
            <form action="">
                <div class="flex flex-wrap -mx-3 ">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
                        სათაური
                      </label>
                    <input value="@if(isset($queries['title'])) {{$queries['title']}} @endif" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="title" type="text" name="title">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="unit">
                        ერთეული
                      </label>
                      <input value="@if(isset($queries['unit'])) {{$queries['unit']}} @endif" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="unit" type="text" name="unit">
                    </div>
                  </div>
                  <div class="flex flex-wrap -mx-3 mt-2">
                      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="pricefrom">
                          ფასი <small>დან</small>
                        </label>
                        <input @if(isset($queries['pricefrom'])) value="{{$queries['pricefrom']}}"@endif class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="pricefrom" type="number" name="pricefrom">
                      </div>
                      <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="pricetill">
                          ფასი <small>მდე</small>
                        </label>
                        <input @if(isset($queries['pricetill'])) value="{{$queries['pricetill']}}"@endif class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="pricetill" type="number" name="pricetill">
                      </div>
                    </div>
                    <div class="flex">
                        <button class="w-3/4 mt-2 block appearance-none font-bold font-caps bg-indigo-500 text-xs text-white bg-gray-200 border border-gray-200  py-3 px-4 rounded leading-tight">
                            ძებნა
                          </button>   
                          <a href="{{url()->current()}}" class="w-1/4 mt-2 block appearance-none flex items-center justify-center font-bold font-caps bg-red-500 text-xs text-white bg-gray-200 border border-gray-200  py-3 px-4  rounded leading-tight">
                            <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                              </svg>
                            </a>   
                    </div> </form>
        </div>
    </div>
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