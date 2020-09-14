@extends('theme.layout.layout')

@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto font-helvetica">
        ახალი სერვისის რეგისტრაცია
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-8">
    <form  action="{{route('StoreService')}}"  method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex">
          <div class="w-1/3 p-2">
            <input type="text" required  name="title_ge"  class="font-normal text-sm intro-y input input--lg w-full box pr-10 placeholder-theme-13 m-0 mb-3" placeholder="სათაური-GE">
            @error('title-ge')
            <span class="invalid-feedback" role="alert">
                <strong style="color: tomato">{{ $message }}</strong>
                
                </span>
            @enderror
        </div>
            <div class="w-1/3 p-2">
                <input type="text"  name="title_ru"  class="font-normal text-sm intro-y input input--lg w-full box pr-10 placeholder-theme-13 m-0 mb-3" placeholder="სათაური-RU">
                @error('title-ru')
                <span class="invalid-feedback" role="alert">
                    <strong style="color: tomato">{{ $message }}</strong>
                </span>
            @enderror
        </div>
         <div class="w-1/3 p-2">
            <input type="text"  name="title_en" class="font-normal text-sm intro-y input input--lg w-full box pr-10 placeholder-theme-13 m-0 mb-3" placeholder="სათაური-EN">
            @error('title-en')
            <span class="invalid-feedback" role="alert">
                <strong style="color: tomato">{{ $message }}</strong>
            </span>
        @enderror
    </div>
        </div>
        <div class="intro-y box p-5">
                
            <div class="flex">
                <div class="w-1/3 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">კატეგორია_GE</label> <br>
                    <input type="text" autocomplete="off" name="category-ge" id="category-ge"  class="font-normal text-sm input w-full border category mt-2" placeholder="აირჩიეთ კატეგორია">
                </div>
                <div class="w-1/3 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">კატეგორია_RU</label> <br>
                    <input type="text" autocomplete="off" name="category-ru" id="category-ru"  class="font-normal text-sm input w-full border category mt-2" placeholder="აირჩიეთ კატეგორია">
                </div>
                <div class="w-1/3 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">კატეგორია_EN</label> <br>
                    <input type="text" autocomplete="off" name="category-en" id="categor-en"   class="font-normal text-sm input w-full border category mt-2" placeholder="აირჩიეთ კატეგორია">
                </div>
               </div>
               <div class="flex">
                   <div class="w-1/2 p-2">
                       <label class="font-bold font-caps text-xs text-gray-700">ხანგრძლივობა <span class="text-red-500">*</span></label>
                       <input required type="number" min="0" step="1" name="duration_count" id="duration_count" class="font-normal text-sm input w-full border mt-2" placeholder="მიუთითეთ დრო">
                   </div>
                <div class="w-1/2 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">ხანგრძლივობის ტიპი <span class="text-red-500">*</span></label>
                   <select required data-placeholder="Select a Duration Type" name="duration_type" class=" select2 w-full font-normal text-sm" >
                       <option value="minute">წუთი</option>
                       <option value="hours">საათი</option>
                       <option value="day">დღე</option>
                    </select>
                </div>
               </div>
               <div class="w-full p-2">
                <label class="font-bold font-caps text-xs text-gray-700">ფასი</label>
                <div class="relative mt-2">
                    <input type="number" min="0" step="0.01"  name="price" name="price" class="font-normal text-sm input pr-12 w-full border col-span-4" placeholder="ფასი">
                    <div class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600">₾</div>
                </div>
                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong style="color: tomato">{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="flex">
                
                <div class="w-1/3 p-2">
                    <div class="flex justify-between align-items-center">
                        <label class="font-bold font-caps text-xs text-gray-700">ერთეული_GE</label>
                    </div>
                    <input type="text" name="unit-ge"  class="font-normal text-sm input w-full border mt-2" placeholder="ჩაწერეთ ერთეულის სახელი">
                  
                </div>
                <div class="w-1/3 p-2">
                    <div class="flex justify-between align-items-center">
                        <label class="font-bold font-caps text-xs text-gray-700">ერთეული_RU</label>
                    </div>
                    <input type="text" name="unit-ru"  class="font-normal text-sm input w-full border mt-2" placeholder="ჩაწერეთ ერთეულის სახელი">
                  
                </div>
                <div class="w-1/3 p-2">
                    <div class="flex justify-between align-items-center">
                        <label class="font-bold font-caps text-xs text-gray-700">ერთეული_EN</label>
                    </div>
                    <input type="text" name="unit-en"  class="font-normal text-sm input w-full border mt-2" placeholder="ჩაწერეთ ერთეულის სახელი">
                  
                </div>
              </div>
              <div>
                <div class="w-full p-2">
                     <label class="font-bold font-caps text-xs text-gray-700">სურათი</label>
                    <div class="border-2 border-dashed rounded-md mt-2 pt-1">
                    <div class="relative mt-1">
                    <div class="px-4 pb-2 flex items-center cursor-pointer relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image w-4 h-4 mr-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg> <span class="text-theme-1 mr-1 font-bold font-caps text-xs ">ატვირთეთ ფაილი</span> 
                        <input type="file" name="file" class="w-full h-full top-0 left-0 absolute opacity-0" accept='image/*'>
                    </div>
                    </div>
                </div>
                </div>
              </div>
              <div class="mt-2">
                  <label class="font-bold font-caps text-xs text-gray-700">აღწერა_GE</label>
                  
                  <textarea data-feature="basic" class="summernote" name="editor-ge" style="display: none;">
                     
                  </textarea>
                  </div>
                  @error('editor-ge')
                  <span class="invalid-feedback" role="alert">
                      <strong style="color: tomato">{{ $message }}</strong>
                  </span>
              @enderror
                  <br>
                  <div class="mt-2">
                      <label class="font-bold font-caps text-xs text-gray-700">აღწერა_RU</label>
                      
                      <textarea data-feature="basic" class="summernote" name="editor-ru" style="display: none;">
                        
                      </textarea>
                      </div>
                      @error('editor-ru')
                      <span class="invalid-feedback" role="alert">
                          <strong style="color: tomato">{{ $message }}</strong>
                      </span>
                  @enderror
                      <br>
                      <div class="mt-2">
                          <label class="font-bold font-caps text-xs text-gray-700">აღწერა_EN</label>
                          
                          <textarea data-feature="basic" class="summernote" name="editor-en" style="display: none;">
                              
                          </textarea>
                          </div>
                          @error('editor-en')
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
        $('.service-category-dropdown li').click(function($this){
            alert($(this).html());
        });
    });
</script>
@endsection
