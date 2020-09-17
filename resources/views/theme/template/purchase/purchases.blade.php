@extends('theme.layout.layout')

@section('content')
<h2 class="intro-y text-lg font-medium mt-10 font-medium font-caps">
    შესყიდვების ჩამონათვალი
</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <a href="/purchases/create" class="button text-white bg-theme-1 shadow-md mr-2 font-bold font-caps text-xs">დაამატეთ ახალი</a>
   
        <div class="hidden md:block mx-auto text-gray-600 font-normal text-xs">ნაჩვენებია {{$purchases->count()}}</div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-gray-700">
                
               </div>
        </div>
    </div>
    <table class="table table-report -mt-2 col-span-12">
        <thead>
            <tr>
                <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">ნომერი</th>
                <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">ბოლო განახლება</th>
                <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">მომწოდებელი</th>
                <th class="text-center whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">ფასი</th>
                <th class="text-center whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">პრივილეგია</th>
            </tr>
        </thead>
        <tbody>

           @if ($purchases)
           @foreach ($purchases as $purchase)
                
           <tr class="intro-x">
            <td>
                @if ($purchase->overhead_number)
                <h6 class="font-bolder text-black">#{{$purchase->overhead_number}}</h6>
                <small class="font-normal">ზედნადების ნომერი</small>
                @elseif($purchase->purchase_number)
                <h6 class="font-bolder text-black">#{{$purchase->purchase_number}}</h6>
                <small class="font-normal">ნასყიდობის ნომერი</small>
                @endif
            </td>
            <td class="font-normal">
                {{$purchase->updated_at}} <br>
                @if ($purchase->dgg)
                    <span class="bg-green-500 text-xs p-1 rounded font-normal font-caps text-white">დღღ</span>
                @endif
            </td>
            <td class="font-normal">
                {{$purchase->getDistributorName($purchase->distributor_id)}}
            </td>
            <td class="text-center whitespace-no-wrap font-normal">
                <?php
                $sum = 0;
                foreach ( json_decode($purchase->array) as $receipt )
                {
                    $sum += $receipt->quantity * ($receipt->unit_price/100);
                }
                echo $sum;
                ?> ₾
            </td>
            <td class="text-center whitespace-no-wrap font-normal">
                <div class="flex items-center justify-center w-full">
                    <a href="/purchases/edit/{{$purchase->id}}" class="p-2 bg-gray-300 rounded-lg">
                        <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                          </svg>
                        </a>
                        <a href="{{route('RemovePurchase', $purchase->id)}}" class="p-2 bg-gray-300 rounded-lg ml-2">
                            <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-trash2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3.18 4l1.528 9.164a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836L12.82 4H3.18zm.541 9.329A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671L14 3H2l1.721 10.329z"/>
                                <path d="M14 3c0 1.105-2.686 2-6 2s-6-.895-6-2 2.686-2 6-2 6 .895 6 2z"/>
                                <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                              </svg>
                            </a>
                </div>
            </td>
           </tr>
           @endforeach
           @endif
           {{$purchases->links()}}

            


        </tbody>
    </table>
</div>
@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$('.side-menu').removeClass('side-menu--active');
		$('.side-menu[data-menu="purchases"]').addClass('side-menu--active');
        
    });
    

</script>
@endsection