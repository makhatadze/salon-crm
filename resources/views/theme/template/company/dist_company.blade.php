@extends('theme.layout.layout')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto font-helvetica">
        ახალი სადისტრიბუციო კომპანია
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
           <a href="/companies/dist/create" type="button" class="button button--lg block text-white bg-theme-1 font-helvetica mx-auto mt-8"> 
               დამატება
           </a>
    </div>
</div>
<div class="intro-y box overflow-hidden mt-5">
    <div class="px-5 sm:px-16 py-10 sm:py-20">
        <div class="overflow-x-auto grid grid-cols-12">
            @foreach ($distcompanies as $company)
            <div class="col-span-4 p-2">
                <div class="bg-gray-200 p-4 rounded-md">
                    <a href="/companies/dist/edit/{{$company->id}}" class="mb-2 flex justify-between items-center">
                            <img src="{{asset('../img/delivery-truck.svg')}}" class="w-8 h-8 object-contain">
                            <div>
                                <h6 class="font-normal text-xs">{{$company->{'name_'.app()->getLocale()} }}</h6>
                                <strong class="font-bold text-xs"> #{{$company->code}} </strong>
                            </div>
                    </a>
                    <hr>
                    @foreach ($company->purchases as $purchase)
                    <a href="/purchases/edit/{{$purchase->id}}" class="my-2 zoom-in flex items-center justify-between">
                        <div>
                            @if ($purchase->purchase_type == "overhead")
                            <h6 class="font-bolder text-black">#{{$purchase->overhead_number}}</h6>
                            <small class="font-normal">ზედნადების ნომერი</small>
                            @elseif($purchase->purchase_type == "purchase")
                            <h6 class="font-bolder text-black">#{{$purchase->purchase_number}}</h6>
                            <small class="font-normal">ნასყიდობის ნომერი</small>
                            @endif
                        </div>
                        <div>
                            <h6>{{$purchase->distributor->{'name_'.app()->getLocale()} }}</h6>
                        <small>{{$purchase->updated_at}}</small>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.side-menu').removeClass('side-menu--active');
		$('.side-menu[data-menu="companies"]').addClass('side-menu--active');
        
	});

</script>
@endsection