@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 gap-6 mt-5">
<div class="intro-y col-span-12 lg:col-span-6">
    <div>
        <label class="font-helvetica">სათაური ქართულად</label>
        <input type="text" class="input w-full border mt-2" name="title_ge">
    </div>
    <div>
        <label class="font-helvetica">სათაური რუსულად</label>
        <input type="text" class="input w-full border mt-2" name="title_ru">
    </div>
    <div>
        <label class="font-helvetica">სათაური ინგლისურად</label>
        <input type="text" class="input w-full border mt-2" name="title_en">
    </div>
    <div class="intro-y box mt-2 p-5">
        <div class="mt-2">
            <label class="font-helvetica">ოფისი</label>
            
            <select data-placeholder="Select your favorite actors" name="get_office" class="select2 w-full" >
                @foreach ($departments as $department)
            <option value="{{$department->id}}"> {{$department->{"name_".app()->getLocale()} }} | {{$department->departmentable()->first()->{"name_".app()->getLocale()} }}</option>
                @endforeach
            </select>
        </div>
    <div class="mt-2">
        <label class="font-helvetica">კატეგორია</label>
        <select data-placeholder="Select your favorite actors" class="select2 w-full" name="get_category">
            <option value="1" selected>Leonardo DiCaprio</option>
            <option value="2">Johnny Deep</option>
            <option value="3">Robert Downey, Jr</option>
            <option value="4">Samuel L. Jackson</option>
            <option value="5">Morgan Freeman</option>
        </select>
    </div>
        <div class="mt-3">
            <label class="font-helvetica">სურათები</label>
            <div class="border-2 border-dashed rounded-md mt-3 pt-4">
                <div class="flex flex-wrap px-4">
                    <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                        <img class="rounded-md" alt="Midone Tailwind HTML Admin Template" src="dist/images/preview-6.jpg">
                        <div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2 tooltipstered"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> </div>
                    </div>
                </div>
                <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image w-4 h-4 mr-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg> <span class="text-theme-1 mr-1">Upload a file</span> or drag and drop 
                    <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0" name="images">
                </div>
            </div>
        </div>
    
    <div class="mt-3">
        <label class="font-helvetica">აღწერა ქართულად</label>
        <div class="mt-2">
            <textarea data-feature="basic" class="summernote" name="editor-ge" style="display: none;"></textarea>
        </div>
        <label class="font-helvetica">აღწერა რუსულად</label>
        <div class="mt-2">
            <textarea data-feature="basic" class="summernote" name="editor-ru" style="display: none;"></textarea>
        </div>
        <label class="font-helvetica">აღწერა ინგლისურად</label>
        <div class="mt-2">
            <textarea data-feature="basic" class="summernote" name="editor-en" style="display: none;"></textarea>
        </div>
    </div>
</div>
</div>

</div>
@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.side-menu').removeClass('side-menu--active');
		$('.side-menu[data-menu="products"]').addClass('side-menu--active');
        
    });
    
    //products
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    .ajax({
         type:'POST',
         url:'/ajax',
         data:{''}
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         success:function(data){
            $("#msg").html(data.msg);
         }
      });
    
</script>
@endsection