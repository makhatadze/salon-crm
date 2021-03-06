@extends('theme.layout.layout')

@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
            <div class="col-span-12  md:col-span-5">
                <div class="intro-x flex items-center h-10">
                    <h2 class="font-bolder font-caps text-lg text-gray-700 truncate mr-5">
                        @lang('newsale.cart')
                    </h2>
                </div>
                <form class="box  mt-5 p-4" method="POST">
                    @csrf
                    <div class="w-full mb-6 md:mb-3">
                        <label class="block font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="select_product">
                            @lang('newsale.products')
                        </label>
                        <div class="relative">
                            <select
                                class="block appearance-none w-full font-medium text-xs bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="select_product" name="select_product" required>
                                <option value="">@lang('newsale.choose')</option>
                                @foreach ($products as $prod)
                                    <option value="{{ $prod->id }}">{{ $prod->title_ge }}</option>
                                @endforeach

                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase font-caps tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="prod_unit">
                                @lang('newsale.units')
                            </label>
                            <input required
                                class="appearance-none font-medium font-caps text-xs block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="prod_unit" name="prod_unit" readonly type="text">
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase font-caps tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="quantity1">
                                @lang('newsale.amout')
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="quantity1" name="quantity" type="number" required min="0" placeholder="xxxxxx">
                                @if(session('error'))
                                    <p class="text-red-500 font-normal text-xs">{{session('error')}}</p>
                                @endif
                        </div>
                    </div>
                    <button id="submitcat" type="submit"
                        class="appearance-none block w-full bg-indigo-500 text-white font-bolder font-caps text-xs border border-gray-200 rounded py-3 px-4 leading-tight">
                        @lang('newsale.addtocart')
                    </button>
                </form>
            </div>
        </div>
        <div class="col-span-12 xxl:col-span-3  -mb-10 pb-10">
            <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8">
                <div class="intro-x flex justify-between items-center h-10">
                    <h2 class="font-bolder font-caps text-lg text-gray-700 truncate mr-5">
                        კალათა
                    </h2>
                    <span id="cartsum"> {{number_format($cartsum/100, 2)}} <sup>@lang('money.icon')</sup></span>
                </div>
                <div class="mt-5">
                    @if($cart)
                    <div class="intro-x" id="cart">
                        @foreach ($cart as $item)
                        <div class="removecart{{$item->id}}">
                            <div class="box  relative zoom-in">
                            <div id="{{$item->id}}" class="removecart h-5 font-bold text-xs  text-white flex items-center justify-center w-5 bg-red-500 rounded-full absolute top-0 left-0">x</div>
                            <a  href="javascript:;" class=" px-5 py-3 mb-3 flex items-center  " data-toggle="modal" data-target="#basic-modal-{{$item->id}}">
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium font-caps">{{ $item->name }}</div>
                                            <div class="text-gray-600 text-xs font-normal">{{ $item->quantity }} @if($item->attributes['unit'] == "gram") @lang('newsale.gram') @elseif($item->attributes['unit'] == "metre") @lang('newsale.centimeter') @elseif($item->attributes['unit'] == "unit") @lang('newsale.unit') @endif</div>
                                        </div>
                                        <div >
                                            <h6 class="text-theme-9">{{ number_format(($item->price * $item->quantity)/100, 2)}} <sup>@lang('money.icon')</sup></h6>
                                            <span class="font-bold text-xs">{{ $item->price/100 }}  <sup>@lang('money.icon')</sup></span>
                                        </div>
                                    </a></div>
                                    
                                <div class="modal" id="basic-modal-{{$item->id}}">
                                    <div class="modal__content p-10 text-center"> 
                                    <form class="w-full max-w-lg" method="POST" action="{{ route('UpdateCart', $item->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="w-full flex items-center px-3 mb-6 md:mb-0">
                                                <label class="block font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                                    @lang('newsale.amout')
                                                </label>
                                            <input name="quantity" class="ml-3 appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="quantity" type="number" min="0" step="1" value="{{$item->quantity}}">
                                              </div>
                                              <button class="w-full ml-3 appearance-none block bg-indigo-500 text-white font-bold text-xs font-caps border rounded py-3 px-4 mb-3">
                                                @lang('newsale.update')
                                              </button>
                                          </form>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="javascript:;" data-toggle="modal" data-target="#submit_purchases"
                        class="intro-x w-full block text-center rounded-md text-xs py-3 border border-dotted border-theme-15 text-theme-16 font-bolder font-caps">
                        @lang('newsale.buy') </a>
                        <div class="modal show" id="submit_purchases">
                           <div class="modal__content bg-gray-300 modal__content--xl p-10 flex"> 

                           <form action="{{ route('addToSales') }}" method="POST" class="w-1/3">
                            @csrf
                                <div class="flex flex-wrap -mx-3 mb-6 flex">
                                    <div class="w-full  px-3 mb-6 md:mb-0">
                                        <div class="relative">
                                          <select required name="client_id" class="font-normal text-xs block appearance-none font-medium text-xs w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                                            <option value="">@lang('newsale.chooseclient')</option>
                                            @foreach ($clients as $client)
                                          <option value="{{$client->id}}">{{$client->full_name_ge }}</option>
                                            @endforeach
                                          </select>
                                          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="w-full px-3 mb-6 md:mb-0 mt-2">
                                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="address">
                                            @lang('newsale.address') 
                                          </label>
                                          <input required class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="address" name="address" type="text" placeholder="@lang('newsale.address')">
                                        </div>
                                          <div class="w-full px-3 mb-6 md:mb-0 mt-2">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="paymethod">
                                                @lang('newsale.method')
                                            </label>
                                            <div class="relative">
                                                <select required class="font-normal text-xs block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="paymethod" name="paymethod">
                                                    <option value="">@lang('newsale.choose')</option>
                                                    <option value="consignation">@lang('newsale.consignation')</option>
                                                    @foreach ($paymethods as $pay)
                                                    <option value="{{$pay->id}}" >{{$pay->name_ge }}</option>
                                                    
                                                  @endforeach
                                                </select>
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                                </div>
                                              </div>    
                                        </div>
                                        <div id="consignation"  class="hidden w-full px-3 mb-6 md:mb-0 mt-2">
                                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="paied">
                                                @lang('newsale.paid')
                                            </label>
                                            <input class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="paied" name="paid" type="number" min="0" max="{{$cartsum/100}}" step="0.01" placeholder="@lang('newsale.paid')">
                                          </div>
                                          <div class="flex items-center p-3">
                                              <input type="checkbox" name="notaddonsalary" id="notaddonsalary">
                                              <label for="notaddonsalary" class="ml-2 font-normal text-xs">
                                                  ხელფასს <strong>არ</strong> დაემატოს
                                              </label>
                                          </div>
                                      <div class="flex mt-3 w-full text-center px-2">
                                        <div class="w-full md:w-1/2 px-1">
                                            <input class="appearance-none block w-full bg-indigo-500 text-white font-bold font-caps border rounded py-3 px-4 mb-3 leading-tight " style="font-size:0.7rem" value="@lang('newsale.submit')" type="submit" >
                                          </div>
                                        <div class="w-full md:w-1/2 px-1">
                                        <a href="{{ route('CreateClient') }}" target="_blank" class="appearance-none block w-full bg-green-500 text-white font-bold  font-caps border border-gray-200 rounded py-3 px-4 leading-tight" style="font-size: 0.7rem">
                                            @lang('newsale.newclient')
                                          </a>
                                        </div>
                                      </div>
                                  </div>
                               </form>
                               <div class="w-2/3 px-5">
                                @foreach ($cart as $item)
                                <div class="removecart{{$item->id}}">
                                    <div class="box bg-gray-200 relative zoom-in">
                                    <div id="{{$item->id}}" class="removecart h-5 font-bold text-xs  text-white flex items-center justify-center w-5 bg-red-500 rounded-full absolute top-0 left-0">x</div>
                                    <a  href="javascript:;" class=" px-5 py-3 mb-3 flex items-center  " >
                                                <div class="ml-4 mr-auto">
                                                    <div class="font-medium font-caps">{{ $item->name }}</div>
                                                    <div class="text-gray-600 text-xs font-normal">{{ $item->quantity }} @if($item->attributes['unit'] == "gram") @lang('newsale.gram') @elseif($item->attributes['unit'] == "metre") @lang('newsale.centimeter') @elseif($item->attributes['unit'] == "unit") @lang('newsale.unit') @endif</div>
                                                </div>
                                                <div >
                                                    <h6 class="text-theme-9">{{ number_format(($item->price * $item->quantity)/100, 2)}} <sup>₾</sup></h6>
                                                    <span class="font-bold text-xs">{{ $item->price/100 }}  <sup> @if ($item->attributes['currency'] == "gel") @lang('money.icon')  @endif</sup></span>
                                                </div>
                                            </a></div>
                                            
                                </div>
                                @endforeach
                                </div>

                            </div>
                        </div>
                        
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.side-menu').removeClass('side-menu--active');
            $('.side-menu[data-menu="shop"]').addClass('side-menu--active');
            $('#menushop ul').addClass('side-menu__sub-open');
            $('#menushop ul').css('display', 'block');

            
            $('#select_product').change(function() {
                let id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('ChooseForCart') }}",
                    method: 'POST',
                    data: {
                        product_id: id,
                    },
                    success: function(result) {
                        if (result.status == true) {
                            let prod = result.product;
                            $unit = prod['unit'];
                            if($unit == "gram"){
                                $('#prod_unit').val("@lang('newsale.gram')")
                            }else if($unit == "metre"){
                                $('#prod_unit').val("@lang('newsale.centimeter')")
                            }else if($unit == "unit"){
                                $('#prod_unit').val("@lang('newsale.unit')")
                            }
                        }
                    }
                });
            });
            $('#paymethod').change(function(){
                if ($(this).val() == "consignation") {
                    $('#consignation').css('display', 'block');
                }else{
                    $('#consignation').css('display', 'none');
                }
            });
            $('.removecart').click(function(){
                let id = $(this).attr('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/removefromcart/"+id,
                    method: 'get',
                    success: function(result) {
                        if (result.status == true) {
                          $('.removecart'+id).remove();
                          $('#cartsum').html(result.cartsum + '<sup>₾</sup>')
                        }
                    }
                });
            });
        });

    </script>
@endsection
