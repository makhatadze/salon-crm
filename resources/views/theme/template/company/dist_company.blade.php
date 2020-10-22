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
<div class=" bg-white mt-5">
    <div class="px-5 sm:px-16 py-10 sm:py-20">
        <div class=" grid grid-cols-12">
            @foreach ($distcompanies as $company)
            <div class="col-span-4 p-2">
                <div class="bg-gray-200 p-4 rounded-md">
                    <div  class="mb-2 flex justify-between items-center">
                            <a href="/companies/dist/edit/{{$company->id}}">
                                <img src="{{asset('../img/delivery-truck.svg')}}" class="w-8 h-8 object-contain">
                                <small>+995{{$company->phone}}</small>
                            </a>
                            @if (auth()->user()->hasAnyPermission(['admin']))
                            <div x-data="{modal: false}">
                                <button @click="modal = true" class="p-2 bg-white focus:outline-none rounded">
                                    <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-chat-left-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v11.586l2-2A2 2 0 0 1 4.414 11H14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                        <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                    </svg>
                                </button>
                                <x-modal x-show="modal">
                                    <form action="{{ route('smsSendPost') }}" method="POST" class="bg-white mx-auto" autocomplete="off">
                                        @csrf
                                      <div class="flex">
                                        <div class="w-full px-3 mb-2">
                                            <label class=" block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                                                <h6 class="font-caps">
                                                    საკონტაქტო პირი
                                                </h6> 
                                            </label>
                                            <input  value="{{$company->contact_to}}" readonly class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text">
                                        </div>
                                            <div class="w-full px-3 mb-2">
                                            <label class=" block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                                                <h6 class="font-caps">
                                                    ნომერი
                                                </h6> 
                                            </label>
                                            <input name="phone" value="{{$company->phone}}" readonly required class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" onkeyup="this.value = this.value.replace(/[^0-9\.]/g, '');" id="phone" type="text" minlength="9" maxlength="9" placeholder="555 11 22 33">
                                            <small class="font-normal">გაგზავნამდე გადაამოწმეთ ნომერი</small> 
                                            @error('phone')
                                                <p class="font-normal text-xs text-red-500">
                                                    {{$message}}
                                                </p>
                                            @enderror
                                        </div>
                                      </div>
                                        <div class="w-full px-3">
                                            <label class="font-caps block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="text">
                                            ტექსტი
                                            </label>
                                            <textarea name="text" id="text" cols="30" rows="5" class="appearance-none resize-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                                            @error('text')
                                                <p class="font-normal text-xs text-red-500">
                                                    {{$message}}
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="px-3 mt-2">
                                            <button type="submit" class="w-full bg-indigo-500 py-3 px-4 text-white font-bold font-caps text-xs">გაგზავნა</button>
                                        </div>
                                    </form>
                                </x-modal>
                            </div>
                            @endif
                            <a href="/companies/dist/edit/{{$company->id}}">
                                <h6 class="font-normal text-xs">{{$company->{'name_'.app()->getLocale()} }}</h6>
                                <strong class="font-bold text-xs"> #{{$company->code}} </strong>
                            </a>
                        </div>
                    <hr>
                    @foreach ($company->purchases as $purchase)
                    <a href="/purchases/edit/{{$purchase->id}}" class="my-2 zoom-in flex items-center justify-between">
                        <div>
                            @if ($purchase->purchase_type == "overhead")
                            <h6 class="font-bolder text-black">#{{$purchase->overhead_number}}</h6>
                            <small class="font-normal">ზედნადების ნომერი</small>
                            @elseif($purchase->purchase_type == "purchase")
                            <h6 class="font-bolder text-black">#{{$purchase->purchase_number}}</h6>
                            <small class="font-normal">ნასყიდობის ნომერი</small>
                            @endif
                        </div>
                        <div>
                            <h6>{{$purchase->distributor->{'name_'.app()->getLocale()} }}</h6>
                        <small>{{$purchase->updated_at}}</small>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endforeach
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