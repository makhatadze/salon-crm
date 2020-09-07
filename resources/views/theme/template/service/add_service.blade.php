@extends('theme.layout.layout')

@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto font-helvetica">
        ახალი სერვისის რეგისტრაცია
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
        <form action="/services" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" id="title" class="intro-y input input--lg w-full box pr-10 placeholder-theme-13 m-0 mb-3" placeholder="სათაური">
        @error('title')
        <span class="invalid-feedback" role="alert">
            <strong style="color: tomato">{{ $message }}</strong>
        </span>
    @enderror
        <div class="intro-y box p-5">
                @csrf
               <div class="flex">
                <div class="w-1/2 p-2">
                    <label>კატეგორია</label>
                    <input type="text" name="category"  id="category" class="input category w-full border mt-2" autocomplete="off" placeholder="ჩაწერეთ ან აირჩიეთ კატეგორია">
                    <ul class="p-2 category-dropdown">
                    </ul>
                </div>
                <div class="w-1/2 p-2">
                    <label>ხანგრძლივობა</label>
                    <input type="text" name="duration" id="duration" class="input w-full border mt-2" placeholder="მიუთითეთ დრო">
                </div>
               </div>
              <div class="flex">
                <div class="w-1/2 p-2">
                    <label>ფასი 1111</label>
                    <div class="relative mt-2">
                        <input type="text" name="price" name="price" class="input pr-12 w-full border col-span-4" placeholder="ფასი">
                        <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">₾</div>
                    </div>
                </div>
                <div class="w-1/2 p-2">
                    <label>სურათი</label>
                    <div class="border-2 border-dashed rounded-md mt-2 pt-1">
                    <div class="relative mt-1">
                    <div class="px-4 pb-2 flex items-center cursor-pointer relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image w-4 h-4 mr-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg> <span class="text-theme-1 mr-1">ატვირთეთ ფაილი</span> 
                        <input type="file" name="file" class="w-full h-full top-0 left-0 absolute opacity-0" accept='image/*'>
                    </div>
                    </div>
                </div>
                </div>
              </div>
              <div id="unit">
                  
                <div class="w-full p-2">
                    <div class="flex justify-between align-items-center">
                        <label class="font-medium">ერთეული</label>
                        <button class="button text-white bg-theme-1 shadow-md mr-1" type="button" id="addunit">+</button>
                    </div>
                    <input type="text" name="unit[]" class="input w-full border mt-2" placeholder="ჩაწერეთ ერთეულის სახელი">
                </div>
              </div>
                <div class="mt-2">
                    <label>აღწერა</label>
                    
                    <textarea data-feature="basic" class="summernote" name="editor" style="display: none;"></textarea>
                    </div>
                    @error('editor')
                    <span class="invalid-feedback" role="alert">
                        <strong style="color: tomato">{{ $message }}</strong>
                    </span>
                @enderror
                    <br>
                    <input type="submit" class=" button text-white bg-theme-1 shadow-md mr-1" value="ატვირთვა">
            </form>
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.side-menu').removeClass('side-menu--active');
		$('.side-menu[data-menu="services"]').addClass('side-menu--active');
        $('#addunit').click(function(){
            $random = Math.floor(Math.random() * 10000);
            $('#unit').append(`<div class="relative m-2 mt-2" id="`+$random+`">
                                    <input type="text" name="unit[]" class="input pr-16 w-full border col-span-4" placeholder="ახალი ერთეული">
                                    <div class="absolute top-0 right-0 rounded-r w-16 h-full flex items-center justify-center bg-gray-100 border text-gray-600" onclick="removeunit(`+$random+`)">წაშლა</div>
                                </div>`);
        });
	});
    function removeunit($id){
        $('#'+$id).remove();
    }
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                }
            });
    $('#category').keyup(function(){
        $.ajax({
                url: '/getcategories',
                data: {'value': $('#category').val(),},
                type: 'POST',
                datatype: 'JSON',
                success: function (response) {
                    if(response.status == true){
                        console.log(response.);
                    }
                }
            }); 
    });
</script>
@endsection
