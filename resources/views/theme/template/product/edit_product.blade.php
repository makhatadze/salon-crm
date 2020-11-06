@extends('theme.layout.layout')

@section('content')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <form action="{{ route('UpdateProduct', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="intro-y box mt-2 p-5">
                    

                    <div class="flex flex-wrap  mb-6">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block font-bold font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                @lang('product.title')
                            </label>
                            <input value="{{ $product->title_ge }}" name="title_ge"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                type="text">
                        </div>
                        
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block font-bold font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                @lang('addpurchase.strix')
                            </label>
                            <input required minlength="0" value="{{ $product->product_code }}" onkeyup="this.value = this.value.replace(/[^0-9\.]/g, '');" name="shtrix"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                type="text">
                        </div>
                       
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block font-bold font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                @lang('product.department')
                            </label>
                            <div class="relative">
                                <select required name="department"
                                    class="block font-medium text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    @foreach ($departments as $item)
                                        @if ($product->department_id == $item->id)
                                            <option value="{{ $item->id }}" selected>
                                                {{ $item->name_ge }}
                                            </option>
                                        @else
                                            <option value="{{ $item->id }}">
                                                {{ $item->name_ge }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('department')
                                <p class="text-xs text-red-500 font-normal">
                                    {{$message}}
                                </p>
                                @enderror
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="flex flex-wrap mt-3 mb-3">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label
                            class="block font-bold font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            @lang('product.brand')
                        </label>
                        <div class="relative">
                            <select name="brand"
                                class="block font-medium text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                               <option value="">@lang('product.choose')</option>
                                @foreach ($brands as $item)
                                    @if ($product->brand_id == $item->id)
                                        <option value="{{ $item->id }}" selected>
                                            {{ $item->name }}
                                        </option>
                                    @else
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                            </div>
                        </div>
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <div>
                                <label for="price"
                                    class="block  leading-5 font-medium text-gray-700 font-bold font-caps text-xs">@lang('product.price')</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input autocomplete="off" type="number" value="{{ $product->price / 100 }}" name="price" min="0"
                                        step="0.01"
                                        class="block font-medium text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        placeholder="xxx.xx">
                                    <div class="absolute inset-y-0 right-0 flex items-center">
                                        <select name="currency" aria-label="Currency"
                                            class="form-select h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm sm:leading-5">
                                            <option value="gel" selected @if ($product->currency_type == 'gel') selected 
                                                    end="@endif"> @lang('money.slug')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    @if ($product->type == 1)
                    <div class="flex flex-wrap mt-3 mb-6">
                        
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block font-bold font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                @lang('product.expstart')
                            </label>
                            <input 
                            class="appearance-none block w-full text-xs font-normal bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                             required type="date" name="expluatation_date" value="{{ Carbon\Carbon::parse($product->expluatation_date)->isoFormat("Y-MM-DD")}}">
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block font-bold font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                @lang('product.cveta')
                            </label>
                            <input 
                            class="appearance-none block w-full text-sm font-normal bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                             required type="number" value="1" min="1" step="1" name="expluatation_days" value="{{ $product->expluatation_days }}">
                        </div>
                        <div>
                            <label
                                class="block font-bold font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                @lang('product.expluatation')</label>
                            <div class="py-3 flex font-normal items-center">
                                
                            <input type="checkbox" name="unlimited_expluatation" @if($product->unlimited_expluatation) checked @endif class="mr-3"> @lang('product.expunlimited')
                            </div>
                        </div>
                    </div>
                    <p class="w-full py-2 font-normal text-xs m-0 px-4">
                        
                         @lang('product.exptext')
                    </p>
                    @endif



                    @if ($product->warehouse == 1 && $product->type != 1 || $product->warehouse == 0)
                    <div class="mt-3 px-3">
                        <label class="font-bold font-caps text-xs">@lang('product.images')</label>
                        <div class="border-2 border-dashed rounded-md mt-3 pt-4">
                            <div class="flex flex-wrap px-4">
                                @if ($product
                                        ->images()
                                        ->where('deleted_at', null)
                                        ->count() > 0)
                                                                @foreach ($product
                                        ->images()
                                        ->where('deleted_at', null)
                                        ->get()
                                    as $image)
                                        <div id="img{{ $image->id }}"
                                            class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                            <img class="rounded-md" alt="Midone Tailwind HTML Admin Template"
                                                src="{{ asset('/storage/productimage/' . $image->name) }}">
                                            <div id="{{ $image->id }}"
                                                class="removeimg tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2 tooltipstered">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-x w-4 h-4">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg> </div>
                                        </div>
                                    @endforeach
                                @endif

                                <div class="flex flex-wrap px-4" id="preloadimages">



                                </div>

                            </div>

                            <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-image w-4 h-4 mr-2">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21 15 16 10 5 21"></polyline>
                                </svg> <span class="text-theme-1 mr-1 font-normal text-xs">@lang('product.imageupload')
                                <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0" accept="image/*"
                                    id="imgInp" name="images[]" multiple>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="my-4 px-3 items-center justify-between flex col-span-12">
                        <h6 class="font-bolder">@lang('product.addfields')</h6>
                        <button type="button" id="addfields" class="bg-gray-200 p-2">
                            <svg width="1.18em" height="1.18em" stroke="black" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                              </svg>
                        </button>
                    </div>
                    <div class="mt-3 px-3 w-full" id="fields">

                        @foreach ($product->fields as $field)
                            <div class="flex" id="{{$field->id}}">
                                <div class="p-2 pl-0 w-3/12">
                                <input value="{{$field->name}}" readonly class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text">
                                </div>
                                <div class="p-2 w-8/12">
                                    <input value="{{$field->description}}" readonly class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text">
                                </div>
                                <div class="pr-2 w-1/12 py-2 flex items-center justify-center">
                                    <span onclick="removefieldajax({{$field->id}})" class="flex items-center justify-center font-bolder text-xs cursor-pointer text-white bg-red-500 p-3 h-5 w-5 rounded-md">
                                        X 
                                    </span>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="mt-3 px-3">
                        <label class="font-bold font-caps text-xs">@lang('product.desc') <span class="text-red-500">*</span> </label>
                        <div class="mt-2">
                            <textarea required data-feature="basic" class="summernote font-normal text-xs" name="editor-ge"
                                style="display: none;">
                            {{ $product->description_ge }}
                            </textarea>
                        </div>
                    </div>

                    <div class="px-3">
                        <input type="submit" class=" mt-2 button text-white bg-theme-1 font-bold font-caps text-xs shadow-md mr-1" value="@lang('product.upload')">
                    </div>
                </div>

            </form>
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

            $('.removeimg').click(function() {
                $id = $(this).attr('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('RemoveImage') }}",
                    method: 'post',
                    data: {
                        imgid: $id,
                    },
                    success: function(result) {
                        if (result.status == true) {
                            $('#img' + $id).remove();
                        }
                    }
                });

            });
            $('#addfields').click(function(){
                $id = Date.now();
                $('#fields').append(`
                <div class="flex" id="`+$id+`">
                    <div class="p-2 pl-0 w-3/12">
                        <input required class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="field_name[]" type="text" placeholder="@lang('product.title')">
                    </div>
                    <div class="p-2 w-8/12">
                        <input required class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="field_description[]" type="text" placeholder="@lang('product.desc')">
                    </div>
                    <div class="pr-2 w-1/12 py-2 flex items-center justify-center">
                        <span onclick="removefield(`+$id+`)" class="flex items-center justify-center font-bolder text-xs cursor-pointer text-white bg-red-500 p-3 h-5 w-5 rounded-md">
                            X 
                        </span>
                    </div>
                </div>
                `);
            });
        });
        function removefieldajax($id){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/products/removefield/"+$id,
                    method: 'get',
                    success: function(result) {
                        if (result.status == true) {
                            removefield($id);
                        }
                    }
                });
        }
        function removefield($id){
            $('#'+$id).remove();
        }
        function readURL(input) {
            if (input.files && input.files[0]) {
                $("#preloadimages").html('');
                $(input.files).each(function() {
                    var reader = new FileReader();
                    reader.readAsDataURL(this);
                    reader.onload = function(e) {
                        $("#preloadimages").append(`
                    <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                            <img class="rounded-md" alt="Midone Tailwind HTML Admin Template" src="` + e.target.result + `">
                            </div>
                    `);
                    }
                });
            }
        }
        $("#imgInp").change(function() {
            readURL(this);
        });

    </script>
@endsection
