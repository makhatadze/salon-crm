<div>
 <div class="box p-3">
    <div x-data="{modal: false}">
      <button @click="modal= true" class="py-2 w-full focus:outline-none bg-indigo-500 font-bolder text-center font-caps text-white" style="font-size: 0.65rem">
          @lang('product.addcategory')
      </button>
      <x-modal x-show="modal">
          <form wire:submit.prevent="addCategory">
              <div class="flex flex-wrap -mx-3 mb-1">
                  <div class="w-full px-3">
                    <div class="flex items-center">
                      <div class="w-full p-2">
                          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title_ge">
                            @lang('product.catname')
                          </label>
                          <input wire:model="title_ge" id="title_ge" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" placeholder="xxxxxxx">
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" @click="modal= false" class="p-2 bg-indigo-500 text-white font-bold text-xs font-caps w-full">
                  @lang('product.catadd')
                </button>
          </form>
      </x-modal>
    </div>
    <ul class="mt-2">
      @foreach ($categories as $cat)
        <li x-data={dropdown:false} class="mt-1">
          <div class="flex items-center hover:bg-gray-200 p-2">
            <svg width="0.7em" x-show="!dropdown" height="0.7em" viewBox="0 0 16 16" class="bi bi-caret-right-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
            </svg>
            <svg width="0.7em" height="0.7em" x-show="dropdown" viewBox="0 0 16 16" class="bi bi-caret-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
            </svg>
            <div class="flex w-full cursor-pointer items-center" @click="dropdown = !dropdown">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi ml-3 bi-folder-fill" fill="#284fa7" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
              </svg>
              <h6 class="ml-3 font-medium text-xs">
                {{$cat->title_ge }}
              </h6>
              
            </div>
            <button x-data="{modal:false}">
              <div class="flex items-center">
                <svg width="1em" @click="modal=true" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                </svg>
                <a href="{{url()->current().'?getcat='.$cat->id}}" class="ml-2">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder-symlink-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2l.04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3zM2.19 3c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672a1 1 0 0 1 .707.293L7.586 3H2.19zm9.608 5.271l-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742z"/>
                  </svg>
                </a>
                
                @if ($cat->subcategories()->count() == 0)
                <span  class="ml-2" wire:click="removecat({{$cat->id}})">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                    <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                  </svg>
                </span>
                @endif
              </div>
              <x-modal x-show="modal">
                    <div class="w-full">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="subcat_name{{$cat->id}}">
                        @lang('product.subcategory')
                      </label>
                      <input id="subcat_name{{$cat->id}}" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" placeholder="xxxxxxxxxx">
                      <span @click="modal= false" wire:click="addSubCat({{$cat->id}}, $('#subcat_name{{$cat->id}}').val())" class="p-2 bg-indigo-500 text-white block text-center font-bold text-xs font-caps w-full">
                        @lang('product.catadd')
                      </span>
                    </div>
              </x-modal>
            </button>
          </div>
          <div class="">
            @foreach ($cat->subcategories as $subcat)
                <ul class="ml-4 mt-2" x-show="dropdown">
                <li class="mt-1" x-data={subdropdown:false}>
                    <div class="hover:bg-gray-200 p-2 flex items-center">
                      <svg width="0.7em" x-show="!subdropdown" height="0.7em" viewBox="0 0 16 16" class="bi bi-caret-right-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                      </svg>
                      <svg width="0.7em" height="0.7em" x-show="subdropdown" viewBox="0 0 16 16" class="bi bi-caret-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                      </svg>
                      <div class="flex w-full cursor-pointer items-center" @click="subdropdown = !subdropdown">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi ml-3 bi-folder-fill" fill="#284fa7" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
                        </svg>
                        <h6 class="ml-3 font-medium text-xs">
                          {{$subcat->name}}
                        </h6>
                    </div>
                    <div x-data="{modal:false}">
                      <div class="flex items-center">
                        <svg width="1em" @click="modal=true" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                        </svg>
                          <a href="{{url()->current().'?getsubcat='.$subcat->id}}" class="ml-2">
                          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder-symlink-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2l.04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3zM2.19 3c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672a1 1 0 0 1 .707.293L7.586 3H2.19zm9.608 5.271l-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742z"/>
                          </svg>
                        </a>
                        @if ($subcat->brands()->count() == 0)
                        <span  class="ml-2" wire:click="removesubcat({{$subcat->id}})">
                          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                            <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                          </svg>
                        </span>
                        @endif

                      </div>
                      <x-modal x-show="modal">
                        <form wire:submit.prevent="addBrand({{$subcat->id}}, $('#brand_name{{$subcat->id}}').val())">
                            <div class="w-full">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="brand_name">
                                  @lang('product.brandname')
                                </label>
                            <input id="brand_name{{$subcat->id}}" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" placeholder="Apple, Microsoft..">
                            </div>
                              <button type="submit" @click="modal= false" class="p-2 bg-indigo-500 text-white font-bold text-xs font-caps w-full">
                                @lang('product.catadd')
                              </button>
                        </form>
                      </x-modal>
                    </div>
                  </div>
                    <ul x-show="subdropdown" class="w-full pl-8 mt-2">
                      @foreach ($subcat->brands as $brand)
                        <li class="flex items-center hover:bg-gray-200 p-2">
                          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi ml-3 bi-folder-fill" fill="#284fa7" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
                          </svg>
                         <div class="flex w-full items-center justify-between">
                          <h6 class="ml-3 font-medium text-xs">{{$brand->name}}</h6>
                          <div class="flex items-center">
                            <a href="{{url()->current().'?getbrand='.$brand->id}}"> 
                              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder-symlink-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2l.04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3zM2.19 3c-.24 0-.47.042-.684.12L1.5 2.98a1 1 0 0 1 1-.98h3.672a1 1 0 0 1 .707.293L7.586 3H2.19zm9.608 5.271l-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742z"/>
                              </svg>
                            </a>
                            @if ($brand->products()->count() == 0)
                              <span wire:click="removebrand({{$brand->id}})" class="ml-2"> 
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                                  <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                                </svg>
                              </span>
                            @endif
                          </div>
                         </div>
                        </li>
                      @endforeach
                    </ul>
                  </li>
                </ul>
            @endforeach
          </div>
        </li>
      @endforeach
    </ul>
 </div>
                   
</div>
