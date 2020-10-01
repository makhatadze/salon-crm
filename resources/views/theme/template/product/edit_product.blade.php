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
                                სათაური ქართულად
                            </label>
                            <input value="{{ $product->title_ge }}" name="title_ge"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                type="text">
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block font-bold font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                სათაური რუსულად
                            </label>
                            <input value="{{ $product->title_ru }}" name="title_ru"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                type="text">
                        </div>
                        <div class="w-full md:w-1/3 px-3">
                            <label
                                class="block font-bold font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                სათაური ინგლისურად
                            </label>
                            <input value="{{ $product->title_en }}" name="title_en"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                type="text">
                        </div>
                    </div>
                    <div class="flex flex-wrap mt-3 mb-6">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block font-bold font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                ერთეული
                            </label>
                            <div class="relative">
                                <select name="unit" readonly 
                                    class="block font-medium text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option value="unit" @if ($product->unit == 'unit')
                                        selected @endif>ცალი</option>
                                        @if($product->type != 1)
                                         <option value="gram" @if ($product->unit == 'kilo')
                                        selected @endif>გრამი</option>
                                         <option value="metre" @if ($product->unit == 'metre')
                                        selected @endif>სანტიმეტრი</option>
                                        @endif
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
                        <div class="w-full md:w-1/3 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                რაოდენობა
                            </label>
                            <input @if($product->type == 1) readonly @endif
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                type="number" required min="0" value="{{ $product->stock }}" step="0.1" name="stock">
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block font-bold font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                დეპარტამენტი
                            </label>
                            <div class="relative">
                                <select name="department"
                                    class="block font-medium text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    @foreach ($departments as $item)
                                        @if ($product->department_id == $item->id)
                                            <option value="{{ $item->id }}" selected>
                                                {{ $item->{"name_".app()->getLocale()} }}
                                            </option>
                                        @else
                                            <option value="{{ $item->id }}">
                                                {{ $item->{"name_".app()->getLocale()} }}
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
                    </div>
                    <div class="flex">
                        <div class="w-full md:w-1/3 px-3">
                            <div>
                                <label for="price"
                                    class="block  leading-5 font-medium text-gray-700 font-bold font-caps text-xs">ფასი</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input autocomplete="off" value="{{ $product->price / 100 }}" name="price" min="0"
                                        step="0.01"
                                        class="block font-medium text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        placeholder="xxx.xx">
                                    <div class="absolute inset-y-0 right-0 flex items-center">
                                        <select name="currency" aria-label="Currency"
                                            class="form-select h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm sm:leading-5">
                                            <option value="gel" selected @if ($product->currency_type == 'gel') selected </beautify
                                                    end="@endif"> GEL</option>
                                            <option value="usd" @if ($product->currency_type == 'usd') selected </beautify
                                                    end="@endif"> USD</option>
                                            <option value="eur" @if ($product->currency_type == 'eur') selected </beautify
                                                    end="@endif"> EUR</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block font-bold font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                კატეგორია
                            </label>
                            <div class="relative">
                                <select
                                    class="block font-medium text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    name="get_category">
                                    @if ($categories)
                                        @foreach ($categories as $cat)
                                            @if ($product->category->id == $cat->id)
                                                <option value="{{ $cat->id }}" selected>
                                                    {{ $cat->{'title_' . app()->getLocale()} }}</option>
                                            @else
                                                <option value="{{ $cat->id }}">{{ $cat->{'title_' . app()->getLocale()} }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endif
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
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block font-bold font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-state">
                                ტიპი
                            </label>
                            <div class="relative">
                                <select name="get_type"
                                    class="block font-medium text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-state">
                                    <option value="1" @if ($product->type == '1') selected
                                        @endif>ძირითადი საშუალება</option>
                                    <option value="2" @if ($product->type == '2') selected
                                        @endif>ხარჯმასალა</option>
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
                    </div>
                    @if ($product->type == 1)
                    <div class="flex flex-wrap mt-3 mb-6">
                        
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block font-bold font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                ექსპლუიატაციის დაწყება
                            </label>
                            <input 
                            class="appearance-none block w-full text-xs font-normal bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                             required type="date" name="expluatation_date" value="{{ Carbon\Carbon::parse($product->expluatation_date)->isoFormat("Y-MM-DD")}}">
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label
                                class="block font-bold font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                 ხანგრძლოვობა <small>(დღე)</small>
                            </label>
                            <input 
                            class="appearance-none block w-full text-sm font-normal bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                             required type="number" value="1" min="1" step="1" name="expluatation_days" value="{{ $product->expluatation_days }}">
                        </div>
                        <div>
                            <label
                                class="block font-bold font-caps uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                ექსპლუატაცია</label>
                            <div class="py-3 flex font-normal items-center">
                                
                            <input type="checkbox" name="unlimited_expluatation" @if($product->unlimited_expluatation) checked @endif class="mr-3"> უსასრულო ექსპლუატაცია
                            </div>
                        </div>
                    </div>
                    <p class="w-full py-2 font-normal text-xs m-0 px-4">
                        <strong class="text-red-500">შენიშვნა:</strong> უსასრულო ექსპლუიატაციის პრედიოდის მონიშვნის შემთხვევაში პროდუქტის ექსპლუატაციის დაწყების თარიღი
                         და ხანგრძლივობა წაიშლება.
                    </p>
                    @endif




                    <div class="mt-3">
                        <label class="font-helvetica">სურათები</label>
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
                                </svg> <span class="text-theme-1 mr-1">Upload a file</span> or drag and drop
                                <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0" accept="image/*"
                                    id="imgInp" name="images[]" multiple>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="font-helvetica">აღწერა ქართულად <span class="text-red-500">*</span> </label>
                        <div class="mt-2">
                            <textarea required data-feature="basic" class="summernote" name="editor-ge"
                                style="display: none;">
                            {{ $product->description_ge }}
                            </textarea>
                        </div>
                        <label class="font-helvetica">აღწერა რუსულად</label>
                        <div class="mt-2">
                            <textarea data-feature="basic" class="summernote" name="editor-ru" style="display: none;">
                            {{ $product->description_ru }}
                            </textarea>
                        </div>
                        <label class="font-helvetica">აღწერა ინგლისურად</label>
                        <div class="mt-2">
                            <textarea data-feature="basic" class="summernote" name="editor-en" style="display: none;">
                            {{ $product->description_en }}
                            </textarea>
                        </div>
                    </div>

                    <input type="submit" class=" mt-2 button text-white bg-theme-1 shadow-md mr-1" value="ატვირთვა">
                </div>

            </form>
        </div>

    </div>
@endsection
@section('custom_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.side-menu').removeClass('side-menu--active');
            $('.side-menu[data-menu="products"]').addClass('side-menu--active');

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
        });

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
