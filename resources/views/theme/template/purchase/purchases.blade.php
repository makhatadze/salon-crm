@extends('theme.layout.layout')

@section('content')
<h2 class="intro-y text-lg font-medium mt-10 font-medium font-caps">
    შესყიდვების ჩამონათვალი
</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <a href="/purchases/create" class="button text-white bg-theme-1 shadow-md mr-2 font-bold font-caps text-xs">დაამატეთ ახალი</a>
   
        <div class="hidden md:block mx-auto text-gray-600 font-normal text-xs">ნაჩვენებია {{$purchases->count()}}</div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-full relative text-gray-700">
               </div>
        </div>
    </div>
    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
    <table class="table table-report -mt-2 col-span-12">
        <thead>
            <tr>
                <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">ნომერი</th>
                <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">ბოლო განახლება</th>
                <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">მომწოდებელი</th>
                <th class="text-center whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">ფასი</th>
                <th class="text-center whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">პრივილეგია</th>
            </tr>
        </thead>
        <tbody>

           @if ($purchases)
           @foreach ($purchases as $purchase)
                
           <tr>
            <td>
              @if ($purchase->purchase_type == "overhead")
              <h6 class="font-bolder text-black">#{{$purchase->overhead_number}}</h6>
              <small class="font-normal">ზედნადების ნომერი</small>
              @elseif($purchase->purchase_type == "purchase")
              <h6 class="font-bolder text-black">#{{$purchase->purchase_number}}</h6>
              <small class="font-normal">ნასყიდობის ნომერი</small>
              @endif
            </td>
            <td class="font-normal">
                {{$purchase->updated_at}} <br>
                @if ($purchase->dgg)
                    <span class="bg-green-500 text-xs p-1 rounded font-normal font-caps text-white" >დღგ</span>
                @endif
            </td>
            <td class="font-medium text-gray-800">
              {{$purchase->distributor->{'name_'.app()->getLocale()} }} <br>
              <small class="text-gray-600 font-normal">დავ: {{number_format(($purchase->getPrice() - $purchase->paid)/100, 2)}}</small>
            </td>
            <td class="text-center whitespace-no-wrap font-normal">
                <h6>{{number_format($purchase->getPrice()/100, 2)}} ₾</h6>
                @if ($purchase->dgg)
                <small>დღგ: {{number_format($purchase->getPrice()/100*1.8/100, 2)}}</small>
                @endif
            </td>
            <td class="text-center whitespace-no-wrap font-normal">
                <div class="flex items-center justify-center w-full">
                    <a href="/purchases/edit/{{$purchase->id}}" class="p-2 bg-gray-300 rounded-lg">
                        <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg>
                    </a>
                    {{-- <a href="{{route('RemovePurchase', $purchase->id)}}" class="p-2 bg-gray-300 rounded-lg ml-2">
                        <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-trash2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3.18 4l1.528 9.164a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836L12.82 4H3.18zm.541 9.329A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671L14 3H2l1.721 10.329z"/>
                            <path d="M14 3c0 1.105-2.686 2-6 2s-6-.895-6-2 2.686-2 6-2 6 .895 6 2z"/>
                            <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                          </svg>
                      </a> --}}
                    <div x-data="{modal: false}">
                      <button @click="modal = true" class="p-2 @if(!$purchase->paid) bg-red-400 @elseif($purchase->paid == $purchase->getPrice()) bg-green-400 @else bg-orange-400 @endif rounded-lg ml-2">
                        <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-credit-card-2-front-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-2zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
                        </svg>
                      </button>
                      <x-modal x-show="modal">
                        
                        @if($purchase->paid != $purchase->getPrice())
                        <form action="{{route('PayPurchase', $purchase->id)}}" method="POST">
                          @csrf
                          @endif
                          <div class="flex flex-wrap -mx-3 mb-2">
                            <div class="w-full px-3">
                              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="paid">
                                გადახდილი
                              </label>
                              <input class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="paid" type="number" name="paid" value="{{round($purchase->paid/100, 2)}}" min="0" max="{{round($purchase->getPrice()/100, 2)}}" step="0.01" placeholder="გადახდილი თანხა">
                            </div>
                          </div>
                          @if($purchase->paid != $purchase->getPrice())
                          <input class="appearance-none font-bold text-xs font-caps block w-full bg-indigo-500 text-white border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="submit" value="განახლება" >
                          @endif
                        </form>
                      </x-modal>  
                    </div>
                </div>
            </td>
           </tr>
           @endforeach
           @endif
           {{$purchases->links('vendor.pagination.custom')}}

            


        </tbody>
    </table>
</div>
<div class="col-span-12 xxl:col-span-3 -mb-10 pb-10 px-4">
    <h6 class="mt-4 font-bold font-caps text-gray-700 text-xs">
        ფილტრი
    </h6>
    <div class="box mt-4 p-2">
        <form action="" method="GET">
            <div class="flex flex-wrap -mx-3 mb-1">
                <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="code">
                    ნომერი
                  </label>
                  <input @if(isset($queries['code'])) value="{{$queries['code']}}" @endif class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="code" id="code" type="text">
                  
                  @error('code')
                  <p class="text-red-500 text-xs italic">{{ $message }}</p>
                  @enderror
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                      მომწოდებელი
                    </label>
                    <div class="relative">
                      <select name="distributor"  class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                        <option value="">ყველა</option>
                        @foreach ($distributors as $dist)
                        @if(isset($queries['distributor']) && $queries['distributor'] == $dist->id)
                        <option value="{{$dist->id}}" selected>{{$dist->{"name_".app()->getLocale()} }}</option> 
                        @else 
                        <option value="{{$dist->id}}">{{$dist->{"name_".app()->getLocale()} }}</option> 
                        @endif
                        @endforeach
                      </select>
                      @error('distributor')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                      <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="col-span-1">
                  <div class="flex items-center justify-center font-normal text-xs">
                    <input type="checkbox" @if (isset($queries['dept'])) checked @endif id="dept" name="dept">
                    <label for="dept" class="ml-2">დავალიანება</label>
                  </div>
                </div>
                <div class="col-span-1 pl-3">
                  <input data-daterange="true" @if (isset($queries['date'])) value="{{$queries['date']}}"  @endif name="date" class="datepicker input text-xs w-full border block mx-auto"> 
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
        $('.side-menu[data-menu="purchases"]').addClass('side-menu--active');
        $('#menupurchases ul').addClass('side-menu__sub-open');
        $('#menupurchases ul').css('display', 'block');
        
    });
    

</script>
@endsection