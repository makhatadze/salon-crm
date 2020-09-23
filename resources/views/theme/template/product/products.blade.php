@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <a href="/products/create" class="button text-white font-bold font-caps text-xs bg-theme-1 shadow-md mr-2">დამატეთ პროდუქტი</a>
        <div class="dropdown relative">
            <button class="dropdown-toggle button px-2 box text-gray-700">
                <span class="w-5 h-5 flex items-center justify-center"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus w-4 h-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> </span>
            </button>
            <div class="dropdown-box mt-10 absolute w-40 top-0 left-0 z-20">
                <div class="dropdown-box__content box p-2">
                    <a onclick="window.print()" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer w-4 h-4 mr-2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> ბეჭდვა </a>
                    <a href="{{ route('ProductExport') }}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text w-4 h-4 mr-2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> ექსელშ ექსპორტი </a>
                  </div>
            </div>
        </div>
        <div class="hidden md:block mx-auto text-gray-600"></div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-gray-700">
                <input id="searchproduct" type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg> 
            </div>
        </div>
    </div>
    <!-- BEGIN: Data List -->
        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
            <table class="table table-report -mt-2 col-span-12 ">
            <thead>
                <tr>
                    <th class="whitespace-no-wrap font-bold font-caps text-xs text-gray-700">სურათები</th>
                    <th class="whitespace-no-wrap font-bold font-caps text-xs text-gray-700">სახელი</th>
                    <th class="text-center whitespace-no-wrap font-bold font-caps text-xs text-gray-700">ფასი</th>
                    <th class="text-center whitespace-no-wrap font-bold font-caps text-xs text-gray-700">დეპარტამენტი</th>
                    <th class="text-center whitespace-no-wrap font-bold font-caps text-xs text-gray-700">სტატუსი</th>
                    <th class="text-center whitespace-no-wrap"></th>
                </tr>
            </thead>
            <tbody id="products">
                @foreach ($products as $prod)
                <tr class="intro-x" >
                    <td class="w-40" @if($prod->stock == 0)  style="background-color: #ffaeae" @endif>
                        <div class="flex">
                            @foreach ($prod->images()->whereNull('deleted_at')->get() as $key => $image)
                            <div class="w-10 h-10 image-fit zoom-in">
                                <img class="tooltip rounded-full tooltipstered" src="{{asset('../storage/productimage/'.$image->name)}}">
                            </div>
                            @if ($key == 3)
                            @break;
                            @endif
                            @endforeach
                            
                            
                        </div>
                        
                    </td>
                    <td @if($prod->stock == 0)  style="background-color: #ffaeae" @endif>
                        <a href="" class="font-medium whitespace-no-wrap font-bold text-black">{{$prod->{"title_".app()->getLocale()} }}</a> 
                        <div class="text-gray-600 text-xs whitespace-no-wrap font-normal"> @if($prod->category_id){{$prod->getCategoryName($prod->category_id)}}@endif</div>
                    </td>
                    <td  @if($prod->stock == 0)  style="background-color: #ffaeae" @endif class="text-center font-normal">{{$prod->price/100}} ₾</td>
                    <td @if($prod->stock == 0)  style="background-color: #ffaeae" @endif class="text-center font-normal ">
                        <h6 class="text-xs text-gray-900 font-black">
                            {{ $prod->getDepartmentName() }} </h6>
                            <span class="ml-1 text-xs font-normal">
                                {{ $prod->getOfficeName() }}
                            </span>
                        
                    </td>
                    <td @if($prod->stock == 0)  style="background-color: #ffaeae" @endif class="text-center ">
                        <span class="m-0 font-medium text-xs">
                            {{$prod->stock}} 
                            @if($prod->unit == "unit")
                            ერთეული
                            @elseif($prod->unit == "gram")
                            გრამი
                            @elseif($prod->unit == "metre")
                            მეტრი
                            @endif
                        </span>
                             <br>
                                <span class="text-xs font-normal">
                                    @if ($prod->type == "inventory")
                                            ინვენტარი
                                        @elseif($prod->type == "both")
                                        ინვენტარი / გაყიდვები
                                        @elseif($prod->type == "sale")
                                            გაყიდვები
                                        @endif
                                </span>
                           
                        </td>
                        <td @if($prod->stock == 0)  style="background-color: #ffaeae" @endif class="w-40 font-bold font-caps text-xs">
                            @if ($prod->published)
                        <a href="/products/turn/{{$prod->id}}/0" class="flex items-center justify-center text-theme-6"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> გათიშვა </a>
                            @else 
                            <a href="/products/turn/{{$prod->id}}/1" class="flex items-center justify-center text-green-500"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> ჩართვა </a>
                            @endif
                        </td>
                        <td @if($prod->stock == 0)  style="background-color: #ffaeae" @endif class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a href=" {{route('ProductEdit', $prod->id)}} "  class="p-2 bg-gray-300 rounded-lg ml-2" href="javascript:;"> 
                                    <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                      </svg>
                                   </a>
                                <form action="{{route('DeleteProduct', $prod->id)}}" method="get">
                                    @csrf
                                        <button type="submit"  class="p-2 bg-gray-300 rounded-lg ml-2" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal">
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
            </tbody>
        </table>
        {{$products->links('vendor.pagination.custom')}}
    </div>
    <div class="col-span-12 px-4 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
        <h6 class="mt-5 font-bolder font-caps text-xs text-gray-700">ფილტრი</h6>
        <div class="mt-4 p-4 box">
            <form method="GET" >
                <div class="flex flex-wrap -mx-3 mb-1">
                    <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="productname">
                        სახელი
                      </label>
                      <input class="appearance-none block w-full font-normal text-xs bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="productname" name="productname" type="text" placeholder="Name">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="product_category">
                          კატეგორია
                        </label>
                        <div class="relative">
                          <select class="block font-normal text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="product_category" name="product_category">
                            <option value="">ყველა</option>
                            @foreach ($categories as $cat)
                            @if(isset($queries['product_category']) && $queries['product_category'] == $cat->id)
                            <option value="{{$cat->id}}" selected>{{$cat->{'title_'.app()->getLocale()} }}</option>
                            @else
                            <option value="{{$cat->id}}">{{$cat->{'title_'.app()->getLocale()} }}</option>
                            @endif
                            @endforeach
                          </select>
                          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="w-full mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="departments">
                        დეპარტამენტები
                      </label>
                      <div class="relative">
                        <select class="block font-normal text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="departments" name="departments">
                          <option value="">ყველა</option>
                          @foreach ($departments as $dept)
                          @if (isset($queries['departments']) && $queries['departments'] == $dept->id)
                          <option value="{{$dept->id }}" selected>{{$dept->{"name_".app()->getLocale()} }}</option>
                          @else 
                          <option value="{{$dept->id }}">{{$dept->{"name_".app()->getLocale()} }}</option>
                          @endif
                          @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                    </div>
                    <div class="flex mt-3 flex-wrap -mx-3 mb-1">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                          <label for="pricefrom"  class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            ფასი <small>დან</small>
                          </label>
                          <input name="pricefrom" @if(isset($queries['pricefrom'])) value="{{$queries['pricefrom']}}" @endif placeholder="xxxxxxxx" type="number" step="0.01" min="0" id="pricefrom" class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" >
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="pricetill">
                            ფასი <small>მდე</small>
                          </label>
                          <input type="number" placeholder="xxxxxxxx" step="0.01" min="0" id="pricetill" name="pricetill" @if(isset($queries['pricetill'])) value="{{$queries['pricetill']}}" @endif class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        </div>
                      </div>
                      <div class="flex flex-wrap -mx-3 mb-1">
                        <div class="w-full md:w-1/2 px-3 mb-1 md:mb-0">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                            რაოდენობა
                          </label>
                          <input  type="number" placeholder="xxxxxxxx" step="0.01" @if(isset($queries['amout'])) value="{{$queries['amout']}}" @endif min="0" id="amout" name="amout"  class="appearance-none block w-full font-normal text-xs bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                              ერთეული
                            </label>
                            <div class="relative">
                              <select name="unit" class="block font-normal text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                <option value="">ნებისმიერი</option>
                                <option value="gram"  @if(isset($queries['unit']) == "gram") selected @endif>გრამი</option>
                                <option value="unit" @if(isset($queries['unit']) == "unit") selected @endif>ერთეული</option>
                                <option value="metre" @if(isset($queries['unit']) == "metre") selected @endif>მეტრი</option>
                              </select>
                              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                              </div>
                            </div>
                          </div>
                          <p class="px-3 text-gray-600 text-xs italic font-normal">რაოდენობის არჩევის შემთხვევაში გამოიტანს არჩეულ რაოდენობაზე ნაკლებ ან ტოლი მონაცემებს.</p>
                          
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
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.side-menu').removeClass('side-menu--active');
		$('.side-menu[data-menu="products"]').addClass('side-menu--active');
	});

</script>
@endsection