<div>
    <div x-data={modal:false}>
        <span class="bg-gray-200 mr-2 p-2 rounded block cursor-pointer" @click="modal = true">
            <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-cone-striped" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.97 4.88l.953 3.811C10.159 8.878 9.14 9 8 9c-1.14 0-2.158-.122-2.923-.309L6.03 4.88C6.635 4.957 7.3 5 8 5s1.365-.043 1.97-.12zm-.245-.978L8.97.88C8.718-.13 7.282-.13 7.03.88L6.275 3.9C6.8 3.965 7.382 4 8 4c.618 0 1.2-.036 1.725-.098zm4.396 8.613a.5.5 0 0 1 .037.96l-6 2a.5.5 0 0 1-.316 0l-6-2a.5.5 0 0 1 .037-.96l2.391-.598.565-2.257c.862.212 1.964.339 3.165.339s2.303-.127 3.165-.339l.565 2.257 2.391.598z"/>
              </svg>
        </span>
        <x-modal x-show="modal">
           <h6 class="font-bold text-xs text-gray-700 mb-2"> @lang('product.transfertext') : {{$product->parent->product->stock}}</h6>
           <div class="grid grid-cols-2 gap-2">
            <div class="col-span-1">
                <form wire:submit.prevent="takefromstorage">
                    <input type="number" wire:model="takefromstorage"  class="w-full bg-gray-200 py-3 px-4 text-gray-700 font-normal text-xs mb-2" step="1" min="0" max="{{$product->parent->product->stock}}">
                    <input type="submit"  class="w-full bg-indigo-500 py-3 px-4 text-white font-bold font-caps text-xs" value="@lang('product.takefromstorage')">
                </form>
            </div>
            <div class="col-span-1">
                <form wire:submit.prevent="backtostorage">
                    <input type="number" wire:model="backtostorage" class="w-full bg-gray-200 py-3 px-4 text-gray-700 font-normal text-xs mb-2" step="1" min="0" max="{{$product->stock}}">
                    <input type="submit" class="w-full bg-indigo-500 py-3 px-4 text-white font-bold font-caps text-xs" value="@lang('product.backtostorage')">
                </form>
            </div>
           </div>
        </x-modal>
    </div>
</div>
