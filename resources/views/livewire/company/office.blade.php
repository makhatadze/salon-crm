<div>
    <div class="flex mt-2">
        <div class="font-bold bg-green-400 py-2 text-center text-xs fotn-caps w-1/2">
            <div x-data="{modal:false}">
                <button @click="modal=true" class="focus:outline-none">
                    @lang('company.addofice')
                </button>
                <x-modal x-show="modal">
                    <form action="" wire:submit.prevent="addCompany">
                        <div class="flex  -mx-3 mb-3">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                @lang('company.name')
                              </label>
                              <input wire:model="name_ge" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="xxxxxxxxxx">
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                @lang('company.address')
                              </label>
                              <input wire:model="address_ge" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="xxxxxxxxxx">
                            </div>
                          </div>
                          <button type="submit" @click="modal=false" class="w-full bg-indigo-500 py-3 px-4 text-white font-bold text-xs font-caps">
                            @lang('company.add')
                          </button>
                    </form>
                </x-modal>
            </div>
        </div>
        <div class="font-bold bg-green-400 py-2 text-center text-xs fotn-caps w-1/2">
            <a href="companies/{{$company->id}}/edit">@lang('company.edit')</a>
        </div>
    </div>
    @foreach ($offices as $office)
    <div class="flex bg-gray-200 w-full py-3 px-4">
        <div class="text-center font-medium text-gray-800 text-xs fotn-caps w-full md:w-1/2">
            <a href="companies/addoffice/{{$company->id}}">
                <h4 class="w-full font-bold text-xs">{{$office->name_ge }}</h4>
                <small class="font-normal">{{ $office->address_ge }}</small>
            </a>
        </div>
        <div class="font-normal text-left px-1 text-xs fotn-caps w-full md:w-1/2">
            <div>
                <div class="mb-3 flex items-center justify-between">
                    <span class="font-normal" style="font-size: 0.7rem">@lang('company.depts')</span>
                   <div x-data="{modal:false}">
                    <span @click="modal= true" class="p-1 block rounded cursor-pointer" style="background-color: #1860f0">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus" fill="#fff" stroke="white" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                          </svg>
                    </span>
                    <x-modal x-show="modal">
                        <form action="" wire:submit.prevent="addDepartment({{$office->id}})">
                            <div class="flex flex-wrap -mx-3 mb-3">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                    @lang('company.name')
                                  </label>
                                  <input wire:model="dname_ge" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="xxxxxxxxxx">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                    @lang('company.address')
                                  </label>
                                  <input wire:model="daddress_ge" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="xxxxxxxxxx">
                                </div>
                              </div>
                              <button type="submit" @click="modal=false" class="w-full bg-indigo-500 py-3 px-4 text-white font-bold text-xs font-caps">
                                @lang('company.add')
                              </button>
                        </form>
                    </x-modal>
                   </div>
                </div>
                @foreach ($office->departments as $dept)
                    <div class="mt-3">
                        <span>{{$dept->name_ge }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
</div>
