@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 gap-6 mt-5">
<div class="intro-y col-span-12 lg:col-span-6">
<form action="{{route('UpdateProduct', $product->id)}}" method="post" enctype="multipart/form-data">
       @csrf
       @method('PUT')
    <div>
        <label class="font-helvetica">სათაური ქართულად <span class="text-red-500">*</span></label>
    <input required type="text" value="{{$product->title_ge}}" class="input w-full border mt-2" name="title_ge">
    </div>
    <div>
        <label class="font-helvetica">სათაური რუსულად</label>
        <input type="text" value="{{$product->title_ru}}" class="input w-full border mt-2" name="title_ru">
    </div>
    <div>
        <label class="font-helvetica">სათაური ინგლისურად</label>
        <input type="text" value="{{$product->title_en}}" class="input w-full border mt-2" name="title_en">
    </div>
    <div class="intro-y box mt-2 p-5">
        
        <div class="flex">
            <div class="w-1/3 p-2">
                <label>ფასი</label>
                <div class="relative mt-2">
                    <input required value="{{$product->price/100}}" type="number" min="0" step="0.01" name="price" class="input pr-12 w-full border col-span-4" placeholder="ფასი">
                    <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">₾</div>
                </div>
            </div>
            <div class="w-1/3 p-2">
                <label>რაოდენობა საწყობში</label>
                <div class="relative mt-2">
                    <input type="number" min="0" step="1" value="{{$product->stock}}" name="stock" class="input  w-full border " placeholder="რაოდენობა">
                </div>
            </div>
            <div class="p-2 w-1/3">
                <label class="font-helvetica">ოფისი</label>
                <div class="mt-2">
                    <select data-placeholder="Select a Department" name="get_department" class="font-helvetica select2 w-full" >
                    
                        @foreach ($departments as $department)
                        @if ($product->department_id && $product->department_id == $department->id)
                        <option selected value="{{$department->id}}"> {{$department->{"name_".app()->getLocale()} }} | {{$department->departmentable()->first()->{"name_".app()->getLocale()} }}</option>
                        @else 
                        <option value="{{$department->id}}"> {{$department->{"name_".app()->getLocale()} }} | {{$department->departmentable()->first()->{"name_".app()->getLocale()} }}</option>
                        @endif
                        
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <label class="font-helvetica">კატეგორია</label>
            <select data-placeholder="აირჩიეთ კატეგორია" class="pr-12 select2 w-full" name="get_category" >
                @if ($categories)
                <option value="" selected></option>
                    @foreach ($categories as $cat)
                    <option value="{{$cat->id}}" >{{$cat->{'title_'.app()->getLocale()} }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="mt-2">
            <label class="font-helvetica">ახალი კატეგორია</label><br>
            <small class="font-helvetica">ახალი კატეგორიის შეყვანის შემთხვევაში, პროდუქტის კატეგორიად ეს ჩაითვლება.</small>
            <div class="flex">
                <div class="w-1/3 p-2">
                    <input type="text" placeholder="ქართულად" class="input w-full border mt-2 font-helvetica" name="new_category_ge">
                </div>
                <div class="w-1/3 p-2">
                    <input type="text" placeholder="რუსულად" class="input w-full border mt-2 font-helvetica" name="new_category_ru">
                </div>
                <div class="w-1/3 p-2">
                    <input type="text" placeholder="ინგლისურად" class="input w-full border mt-2 font-helvetica" name="new_category_en">
                </div>
            </div>
        </div>
        <div class="mt-3">
            <label class="font-helvetica">სურათები</label>
            <div class="border-2 border-dashed rounded-md mt-3 pt-4">
                <div class="flex flex-wrap px-4">
                    @if ($product->images()->where('deleted_at', null)->count() > 0)
                        @foreach($product->images()->where('deleted_at', null)->get() as $image)
                <div id="img{{$image->id}}" class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                            <img class="rounded-md" alt="Midone Tailwind HTML Admin Template" src="{{asset('/storage/productimage/'.$image->name)}}">
                            <div id="{{$image->id}}" class="removeimg tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2 tooltipstered"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> </div>
                            </div>
                        @endforeach
                    @endif
                  
                    <div class="flex flex-wrap px-4" id="preloadimages">
                    


                    </div>

                </div>
                
                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image w-4 h-4 mr-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg> <span class="text-theme-1 mr-1">Upload a file</span> or drag and drop 
                    <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0" accept="image/*" id="imgInp" name="images[]" multiple>
                </div>
            </div>
        </div>
    
    <div class="mt-3">
        <label class="font-helvetica">აღწერა ქართულად <span class="text-red-500">*</span> </label>
        <div class="mt-2">
            <textarea required data-feature="basic" class="summernote" name="editor-ge" style="display: none;">
                {{$product->description_ge}}
            </textarea>
        </div>
        <label class="font-helvetica">აღწერა რუსულად</label>
        <div class="mt-2">
            <textarea data-feature="basic" class="summernote" name="editor-ru" style="display: none;">
                {{$product->description_ru}}
            </textarea>
        </div>
        <label class="font-helvetica">აღწერა ინგლისურად</label>
        <div class="mt-2">
            <textarea data-feature="basic" class="summernote" name="editor-en" style="display: none;">
                {{$product->description_en}}
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
        
        $('.removeimg').click(function(){
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
                  success: function(result){
                     if(result.status == true){
                         $('#img'+$id).remove();
                     }
                  }});
    
        });
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            $("#preloadimages").html('');
        $(input.files).each(function () {
            var reader = new FileReader();
            reader.readAsDataURL(this);
            reader.onload = function (e) {
                $("#preloadimages").append(`
                <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                        <img class="rounded-md" alt="Midone Tailwind HTML Admin Template" src="` + e.target.result +`">
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