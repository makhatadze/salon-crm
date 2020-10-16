<div>
    <div class="grid grid-cols-12 gap-6 p-3 mt-3">
        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
            
            @foreach ($finances as $finance)
            <div class="grid grid-cols-12 bg-white px-4 py-5 col-span-12">
                <div class="col-span-3 flex items-center">
                    <img src="{{asset('../storage/clientimg/user.jpg')}}" class="object-cover w-10 h-10 rounded-md">
                <a href="/user/showprofile/{{$finance->getuser}}" class="ml-3">
                        <h6 class="font-bolder font-caps text-xs">
                            {{$finance->first_name .' '. $finance->last_name}}
                        </h6>
                        <small class="font-normal">
                            სტილისტი
                        </small>
                    </a>
                </div>
                <div class="col-span-3 flex items-center">
                    @if ($finance->sale_id)
                        <span class="bg-gray-200 p-2 rounded">
                            <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-basket-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z"/>
                            </svg>
                        </span>
                        @elseif($finance->service_id)
                            <span class="bg-gray-200 p-2 rounded">
                                <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-scissors" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M3.5 3.5c-.614-.884-.074-1.962.858-2.5L8 7.226 11.642 1c.932.538 1.472 1.616.858 2.5L8.81 8.61l1.556 2.661a2.5 2.5 0 1 1-.794.637L8 9.73l-1.572 2.177a2.5 2.5 0 1 1-.794-.637L7.19 8.61 3.5 3.5zm2.5 10a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm7 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                </svg>
                            </span>
                            @endif
                        <div class="ml-3">
                            <h6 class="font-normal text-xs">
                                @if ($finance->sale_id)
                                გაყიდული პროდუქცია
                                @elseif($finance->service_id)
                                გაყიდული სერვისი
                                @endif
                            </h6>
                            <small class="font-normal">
                                პროცენტი: <span class="font-bolder"> {{$finance->percent}}% </span>
                                შემოსაველი: <span class="font-bolder"> {{number_format(($finance->service_price/100) * $finance->percent / 100, 2) }} <sup>₾</sup> </span>
                            </small>
                        </div>
                </div>
                <div class="col-span-3 flex items-center">
                    @if ($finance->sale_id && $finance->sale->client->image)
                    <img src="{{asset('../storage/clientimg/'.$finance->sale->client->image->name)}}" class="object-cover w-10 h-10 rounded-md">
                    @elseif ($finance->service_id && $finance->service->clinetserviceable->image)
                    <img src="{{asset('../storage/clientimg/'.$finance->service->clinetserviceable->image->name)}}" class="object-cover w-10 h-10 rounded-md">
                    @else 
                        <img src="{{asset('../storage/clientimg/user.jpg')}}" class="object-contain w-10 h-10 rounded-sm">
                    @endif
                    <a class="ml-3" href="/clients/edit/{{$finance->clientid}}">
                        <h6 class="font-bolder font-caps text-xs">
                            @if ($finance->service_id)
                            {{ $finance->{'full_name_'.app()->getLocale()} }}
                            @elseif ($finance->sale_id)
                            {{ $finance['full_name_'.app()->getLocale()] }}
                            @endif
                        </h6>
                        <small class="font-normal">
                            {{ $finance->number }}
                        </small>
                    </a>
                </div>
                <div class="col-span-3 flex items-center ">
                        <span class="bg-gray-200 p-2 rounded">
                            <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-credit-card-2-front-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-2zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
                              </svg>
                        </span>
                        <div class="ml-3">
                            
                        <h6 class="font-normal">
                            {{$finance->pay1 ? ($finance->pay1 == "consignation" ? "კონსიგნაცია" : $finance->pay1) : $finance->pay2 }}
                        </h6>
                        <small>
                            {{$finance->service_price/100}} <sup>₾</sup>
                        </small>
                        </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="col-span-12 xxl:col-span-3 -mb-10 pb-10">
            <div class="box p-2 mb-2">
               <div class="flex">
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                      კლიენტის სახელი
                    </label>
                    <input wire:model="clientname" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="სახელი">
                  </div>
                  <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    კლიენტის ნომერი
                    </label>
                    <input wire:model="clientnumber" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="სახელი">
                </div>
               </div>
                

            <div class="w-full px-3 mb-2 mt-2">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                    სტილისტის სახელი
                </label>
                <input wire:model="membername" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="სახელი">
            </div>
               <div class="flex">
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                        ფასი <small>-დან</small>
                    </label>
                    <input wire:model="pricefrom" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" min="1" value="1" placeholder="ფასი დან">
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                        ფასი <small>-მდე</small>
                    </label>
                    <input wire:model="pricetill" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" min="1" value="1" placeholder="ფასი მდე">
                </div>
               </div>
            </div>
        </div>
    </div>
</div>
