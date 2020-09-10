@extends('theme.layout.layout')

@section('content')
<h2 class="intro-y text-lg font-medium mt-10 font-helvetica">
    მომხმარებელთა ჩამონათვალი
</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <table class="table table-report -mt-2 col-span-12">
        <thead>
            <tr>
                <th class="whitespace-no-wrap font-helvetica">სათაური</th>
                <th class="whitespace-no-wrap font-helvetica">შექმნის დრო</th>
                <th class="text-center whitespace-no-wrap font-helvetica">დაკავშირებული</th>
                <th class="text-center whitespace-no-wrap font-helvetica">მოქმედება</th>
            </tr>
        </thead>
        <tbody>

           @if ($categories)
           @foreach ($categories as $cat)
                
           <tr class="intro-x">
               <td class="w-40">
                   <div class="flex font-helvetica">
                       {{$cat->{"title_".app()->getLocale()} }}
                   </div>
               </td>
               <td>
               <a href="" class="font-medium whitespace-no-wrap font-helvetica">
                   {{$cat->created_at}}
              </a> 
               </td>
               
               <td class="table-report__action w-56">
               <a href="" class="font-medium whitespace-no-wrap font-helvetica">
                
                       
                @if ($cat->categoryable_type == "App\Service")
                    სერვისები 
                @elseif ($cat->categoryable_type == "App\Product")
                პროდუქტები
                @endif
              </a> 
               </td>
               
               <td class="table-report__action w-56">
                   @if ($cat->categoryable_id)
                   <div class="flex justify-center items-center">
                    <form action="/servicescategory/{{$cat->id}}" method="POST">
                       @csrf
                       @method('DELETE')
                       <button class="flex items-center mr-3 font-helvetica" type="submit">
                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> წაშლა
                   </button>
                   </form>
               </div>
               @else
               <span class="font-helvetica">კატეგორია ID ით არის დაკავშირებული</span>
               
                   @endif
               </td>
           </tr>
           @endforeach
           {{$categories->links()}}
           @endif
            


        </tbody>
    </table>
</div>
@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.side-menu').removeClass('side-menu--active');
		$('.side-menu[data-menu="services"]').addClass('side-menu--active');
        
	});

</script>
@endsection