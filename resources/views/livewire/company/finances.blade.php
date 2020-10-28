<div>
    <div class="grid grid-cols-12 gap-6 p-3 mt-3">
        <div class="col-span-12 xxl:col-span-9 grid grid-cols-10">
            <div class="col-span-10 grid grid-cols-10 font-normal text-xs bg-white p-3">
                <div class="col-span-1  flex items-center justify-center">
                    თარიღი
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    საერთო
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    დანახარჯი
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    ხელფასზე
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    გადახდილი
                </div>
                <div class="col-span-2 flex items-center justify-center">
                    ბანკი
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    სუფთა
                </div>
                <div class="col-span-2 flex items-center justify-center">
                    თანამშრომელი
                </div>
            </div>
            @if ($finances)
            @foreach ($finances  as $item)
            <div class="col-span-10 grid grid-cols-10 mt-2 font-normal text-xs p-3 bg-white">
                <div class="col-span-1 flex items-center justify-center">
                    {{$item->created_at}}
                </div>
                <div class="col-span-1 flex items-center justify-center">
                    {{$item->service_price/100}}
                </div>
                {{-- გასასწორებელია სერვისზე პროდუქტის დამატების შემდეგ ~ ხარჯი --}}
                <div class="col-span-1 flex items-center justify-center">
                    0
                </div>
                <div class="col-span-1 flex items-center justify-center">
                        <h6 class="text-xs font-bold text-gray-700">{{$item->service_price * ($item->percent/100)/100}}</h6>

                </div>
                <div class="col-span-1 flex items-center justify-center">
                    <h6>{{$item->sale ? ($item->sale->pay_method == "consignation" ? 'კონსიგნაცია' : $item->sale->pay_method) : ($item->service->pay_method == "consignation" ? 'კონსიგნაცია' : $item->service->pay_method)}}</h6>
                </div>
                <div class="col-span-2  flex items-center justify-center">
                    ბანკი
                </div>
                {{-- გასასწორებელია სერვისზე პროდუქტის დამატების შემდეგ ~ სუფთა მოგება --}}
                <div class="col-span-1  flex items-center justify-center">
                    @if($item->sale)
                        @if (($item->service_price - $item->sale->totalOriginalPrice())/100 > 0)
                            <span class="text-green-700 font-bold">
                                + {{($item->service_price - $item->sale->totalOriginalPrice() - ($item->service_price * ($item->percent/100)))/100}}
                            </span>
                        @else 
                            <span class="text-red-700 font-bold">
                                - {{($item->service_price - $item->sale->totalOriginalPrice() - ($item->service_price * ($item->percent/100)))/100}}
                            </span>
                        @endif
                    @endif
                </div>
                <div class="col-span-2 flex items-center justify-center">
                    {{$item->user->profile->first_name .' '. $item->user->profile->last_name}}
                </div>
            </div>
            @endforeach
            <div class="w-full block col-span-12 mt-3">
                {{$finances->links()}}
            </div>
            @endif
        </div>
        <div class="col-span-12 xxl:col-span-3 -mb-10 pb-10">
            <div class="bg-white p-2">
                <div class="flex flex-wrap -mx-3 mb-1">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        თანამშრომელი
                      </label>
                      <div class="relative">
                        <select wire:model="user" class="font-normal text-xs block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
                          <option value="">ყველა</option>
                          @foreach ($users as $user)
                          
                              <option value="{{$user->profileable_id}}">{{$user->first_name .' '. $user->last_name}}</option>
                          @endforeach
                        </select> 
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                     </div>
                    <div class="w-full md:w-1/2 px-3">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        შემოსავლის ტიპი
                      </label>
                      <div class="relative">
                        <select wire:model="project" class="font-normal text-xs block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                          <option value="">ყველა</option>
                          <option value="prod">პროდუქტიდან</option>
                          <option value="serv">სერვისიდან</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="flex flex-wrap -mx-3 mb-2 mt-4">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                        თარიღი <small>[დან]</small>
                      </label>
                      <input wire:model="datefrom" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="date">
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                        თარიღი <small>[მდე]</small>
                      </label>
                      <input wire:model="datetill" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="date" >
                    </div>
                  </div>
                  
            </div>
        </div>
    </div>
</div>
