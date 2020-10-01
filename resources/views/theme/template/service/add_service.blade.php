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
                <div class="w-1/4 p-2">
                    <label class="font-bold font-caps text-xs text-gray-700">ხანგრძლივობა <span class="text-red-500">*</span></label>
                    <input required type="number" min="0" step="0.1" name="duration_count" id="duration_count" class="mt-2 font-normal text-sm appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" placeholder="მიუთითეთ დრო">
                </div>
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                 <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-5" for="grid-state">
                   ხანგრძლივობის ტიპი
                 </label>
                 <div class="relative ">
                   <select name="duration_type" class="font-normal text-sm appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-state">
                     <option value="minute">წუთი</option>
                     <option value="hours">საათი</option>
                     <option value="day">დღე</option>
                   </select>
                   <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                     <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                   </div>
                 </div>
               </div>
               <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-5" for="grid-state">
                  კატეგორიები
                </label>
                <div class="relative ">
                  <select name="category" class="font-normal text-sm appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-state">
                    @if ($categories)
                    @foreach ($categories as $cat)
                      <option value="{{$cat->id}}">{{$cat->{"title_".app()->getLocale()} }}</option>
                    @endforeach   
                @endif
                  </select>
                  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                  </div>
                </div>
              </div>
              <div class="w-1/4 p-2">
                <label class="font-bold font-caps text-xs text-gray-700">ახალი კატეგორია</label>
                <input required type="text" name="new_category" id="new_category" class="mt-2 font-normal text-sm appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" placeholder="ახალი კატეგორია">
               
            </div>
          </div>
          <p class="text-xs font-normal text-center">
              <strong class="text-red-500">შენიშვნა:</strong> ახალი კატეგორიის შეყვანის შემთხვევაში არჩეული კატეგორია არ იქნება დამახსოვრებული.
          </p>
               <div class="w-full p-2">
                    <div>
                        <label for="price" class="block  leading-5 font-medium text-gray-700 font-bold font-caps text-xs">ფასი</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                          <input autocomplete="off"  name="price" min="0" step="0.01" class="block font-medium text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="xxx.xx">
                          <div class="absolute inset-y-0 right-0 flex items-center">
                            <select name="currency" aria-label="Currency" class="form-select h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm sm:leading-5">
                              <option value="gel" selected>GEL</option>
                              <option value="usd">USD</option>
                              <option value="eur">EUR</option>
                            </select>
                          </div>
                        </div>
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
                    <input type="text" name="unit-ge"  class="font-normal text-sm appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white mt-2" placeholder="ჩაწერეთ ერთეულის სახელი">
                  
                </div>
                <div class="w-1/3 p-2">
                    <div class="flex justify-between align-items-center">
                        <label class="font-bold font-caps text-xs text-gray-700">ერთეული_RU</label>
                    </div>
                    <input type="text" name="unit-ru"  class="font-normal text-sm appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white mt-2" placeholder="ჩაწერეთ ერთეულის სახელი">
                  
                </div>
                <div class="w-1/3 p-2">
                    <div class="flex justify-between align-items-center">
                        <label class="font-bold font-caps text-xs text-gray-700">ერთეული_EN</label>
                    </div>
                    <input type="text" name="unit-en"  class="font-normal text-sm appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white mt-2" placeholder="ჩაწერეთ ერთეულის სახელი">
                  
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
              <div class="my-4 flex justify-between items-center">
                <span class="font-medium text-base text-gray-700">ინვენტარის დამატება</span>
                <button type="button" id="addunit" class="shadow dropdown-toggle bg-gray-200 button px-2 box text-gray-700 hover:bg-blue-900 hover:text-white">
                  <span class="w-5 h-5 flex items-center justify-center"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus w-4 h-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> </span>
              </button>
            </div>
           <div id="inventory">
             
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
        $('#addunit').click(function(){
            $id = Date.now();
            $('#inventory').append(`
            <div class="w-full relative flex items-center mt-2" id="remove`+$id+`">
                    <span class="text-white px-2 cursor-pointer rounded font-bold right-0 top-0 absolute bg-red-500" onclick="removeinventory('remove`+$id+`')">x</span>
               <div class="mt-3 flex items-center w-full">
                  <div class="w-1/3 p-2">
                      
                      <select required data-placeholder="აირჩიეთ ინვენტარი" onchange="selectinventary(this.value, '`+$id+`')" name="inventory[]" class="font-normal text-xs select2 p-2 w-full border border-gray-300 rounded" >
                        <option value="" selected></option>
                          @foreach ($inventories as $item)
                        <option value="{{$item->id}}">{{$item->{"title_".app()->getLocale()} }}</option>
                          @endforeach
                          
                      </select>
                  </div>
                  <div class="w-1/3 p-2">
                    <input type="text" disabled  required name="unit[]" id="unit`+$id+`"  class="text-xs font-normal input w-full border" placeholder="ერთეული">
                  </div>
                  <div class="w-1/3 p-2">
                    <input type="number" disabled min="0" step="0.1" required name="quantity[]" id="quantity`+$id+`"  class="text-xs font-normal input w-full border" placeholder="რაოდენობა">
                  </div>
               </div>
                </div>
            `);
        });
    });
    function removeinventory($id){
        $('#'+$id).remove();
    }
    function selectinventary($value, $id){
        if($value){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
                  url: "/services/unitname/"+$value,
                  method: 'GET',
                  success: function(result){
                      if(result.status == true){
                          if(result.data == "unit"){
                              $('#unit'+$id).val("ცალი");
                          }else if(result.data == "gram"){
                              $('#unit'+$id).val("გრამი");
                          }else if(result.data == "metre"){
                              $('#unit'+$id).val("სანტიმეტრი");
                          }
                          $('#quantity'+$id).prop('disabled', false);
                      }
                  } 
        });
        }else{
            $('#unit'+$id).val("");
            $('#quantity'+$id).prop('disabled', true);
        }
    }
</script>
@endsection
