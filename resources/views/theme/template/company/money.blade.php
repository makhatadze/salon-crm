@extends('theme.layout.layout')

@section('content')
<div class="p-4">
    <div class="grid grid-cols-3 ">
        <div class="col-span-1 p-4">
            <div class="box py-10 px-3 relative">
                <a href="{{ route('PurchaseExport') }}" class="absolute top-0 mt-3 cursor-pointer mr-3 text-xs font-bold font-caps right-0 flex items-center justify-center">
                    <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-file-earmark-arrow-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                        <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                        <path fill-rule="evenodd" d="M8 6a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 10.293V6.5A.5.5 0 0 1 8 6z"/>
                      </svg>
                    <span class="ml-1">ექსპორტი</span>
                    </a>
                <div class="flex flex-col sm:flex-row items-center">
                    <div class="sm:mr-5">
                        <div class="w-20 h-20 flex items-center justify-center image-fit">
                            <svg width="1.99em" height="1.99em" viewBox="0 0 16 16" class="bi bi-archive-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z"/>
                              </svg>
                        </div>
                    </div>
                    <div class="mr-auto text-center sm:text-left mt-3 sm:mt-0">
                        <a href="" class="font-bolder text-black font-caps text-lg" tabindex="-1">შესყიდვები</a> 
                        <div class="text-gray-600 mt-1 sm:mt-0 font-normal text-gray-700 text-xs">მოდელში მოცემულია ყველა შესყიდვის რაოდენობა, შესყიდვების ერთეულების რაოდენობა და მათი ფასის ჯამი.</div>
                    </div>
                </div>
                <div class="grid mt-4 grid-cols-3">
                    <div class="col-span-1 flex items-center justify-center">
                            <div>
                                <h4 class="text-xl font-bolder">{{$purchase['total']}}</h4>
                                <span class="font-normal text-xs">რაოდენობა</span>
                            </div>
                    </div>
                    <div class="col-span-1 flex items-center justify-center">
                            <div>
                                <h4 class="text-xl font-bolder">{{$purchase['units']}}</h4>
                                <span class="font-normal text-xs">ერთეულები</span>
                            </div>
                    </div>
                    <div class="col-span-1 flex items-center justify-center">
                            <div>
                                <h4 class="text-xl font-bolder">{{$purchase['cost']}} <sup>₾</sup></h4>
                                <span class="font-normal text-xs">ჯამი</span>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1 p-4">
            <div class="box py-10 relative px-3">
                
                <a href="{{ route('ProductExport') }}" class="absolute top-0 mt-3 cursor-pointer mr-3 text-xs font-bold font-caps right-0 flex items-center justify-center">
                    <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-file-earmark-arrow-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                        <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                        <path fill-rule="evenodd" d="M8 6a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 10.293V6.5A.5.5 0 0 1 8 6z"/>
                      </svg>
                    <span class="ml-1">ექსპორტი</span>
                    </a>
                <div class="flex flex-col sm:flex-row items-center">
                    <div class="sm:mr-5">
                        <div class="w-20 h-20 flex items-center justify-center image-fit">
                            <svg width="1.99em" height="1.99em" viewBox="0 0 16 16" class="bi bi-bag-check-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5.5 3.5a2.5 2.5 0 0 1 5 0V4h-5v-.5zm6 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                              </svg>
                        </div>
                    </div>
                    <div class="mr-auto text-center sm:text-left mt-3 sm:mt-0">
                        <a href="" class="font-bolder text-black font-caps text-lg" tabindex="-1">პროდუქტები</a> 
                        <div class="text-gray-600 mt-1 sm:mt-0 font-normal text-gray-700 text-xs">მოდელში მოცემულია ყველა პროდუქტის რაოდენობა, პროდუქტების ჯამური ფასი და შემოსავალი გაყიდულიდან.</div>
                    </div>
                </div>
                <div class="grid mt-4 grid-cols-3">
                    <div class="col-span-1 flex items-center justify-center">
                            <div>
                                <h4 class="text-xl font-bolder">{{$products['total']}}</h4>
                                <span class="font-normal text-xs">რაოდენობა</span>
                            </div>
                    </div>
                    <div class="col-span-1 flex items-center justify-center">
                            <div>
                                <h4 class="text-xl font-bolder">{{$products['sum']}} <sup>₾</sup></h4>
                                <span class="font-normal text-xs">ჯამური ფასი</span>
                            </div>
                    </div>
                    <div class="col-span-1 flex items-center justify-center">
                            <div>
                                <h4 class="text-xl font-bolder">{{round($products['orders'], 2)}} <sup>₾</sup></h4>
                                <span class="font-normal text-xs">შემოსავალი</span>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1 p-4">
            <div class="box py-10 px-3 relative">
                
                <a href="{{ route('UserExport') }}" class="absolute top-0 mt-3 cursor-pointer mr-3 text-xs font-bold font-caps right-0 flex items-center justify-center">
                    <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-file-earmark-arrow-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                        <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                        <path fill-rule="evenodd" d="M8 6a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 10.293V6.5A.5.5 0 0 1 8 6z"/>
                      </svg>
                    <span class="ml-1">ექსპორტი</span>
                    </a>
                <div class="flex flex-col sm:flex-row items-center">
                    <div class="sm:mr-5">
                        <div class="w-20 h-20 flex items-center justify-center image-fit">
                            <svg width="1.99em" height="1.99em" viewBox="0 0 16 16" class="bi bi-cash-stack" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 3H1a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1h-1z"/>
                                <path fill-rule="evenodd" d="M15 5H1v8h14V5zM1 4a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H1z"/>
                                <path d="M13 5a2 2 0 0 0 2 2V5h-2zM3 5a2 2 0 0 1-2 2V5h2zm10 8a2 2 0 0 1 2-2v2h-2zM3 13a2 2 0 0 0-2-2v2h2zm7-4a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/>
                              </svg>
                        </div>
                    </div>
                    <div class="mr-auto text-center sm:text-left mt-3 sm:mt-0">
                        <a href="" class="font-bolder text-black font-caps text-lg" tabindex="-1">ხელფასები</a> 
                        <div class="text-gray-600 mt-1 sm:mt-0 font-normal text-gray-700 text-xs">მოდელში მოცემულია ყველა თანამშრომლის რაოდენობა, გასაცემი ხელფასის ჯამი და სტილისტის მიერ გამომუშავებული ფული.</div>
                    </div>
                </div>
                <div class="grid mt-4 grid-cols-3">
                    <div class="col-span-1 flex items-center justify-center">
                            <div>
                                <h4 class="text-xl font-bolder">{{$users['total']}}</h4>
                                <span class="font-normal text-xs">რაოდენობა</span>
                            </div>
                    </div>
                    <div class="col-span-1 flex items-center justify-center">
                            <div>
                                <h4 class="text-xl font-bolder">{{$users['salary']}} <sup>₾</sup></h4>
                                <span class="font-normal text-xs">ხელფასები</span>
                            </div>
                    </div>
                    <div class="col-span-1 flex items-center justify-center">
                            <div>
                                <h4 class="text-xl font-bolder">{{$users['userearn']}} <sup>₾</sup></h4>
                                <span class="font-normal text-xs">გამომუშავებული</span>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1 p-4">
            <div class="box py-10 px-3 relative">
                
                <a href="{{ route('ClientExcel') }}" class="absolute top-0 mt-3 cursor-pointer mr-3 text-xs font-bold font-caps right-0 flex items-center justify-center">
                    <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-file-earmark-arrow-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                        <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                        <path fill-rule="evenodd" d="M8 6a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 10.293V6.5A.5.5 0 0 1 8 6z"/>
                      </svg>
                    <span class="ml-1">ექსპორტი</span>
                    </a>
                <div class="flex flex-col sm:flex-row items-center">
                    <div class="sm:mr-5">
                        <div class="w-20 h-20 flex items-center justify-center image-fit">
                            <svg width="1.99em" height="1.99em" viewBox="0 0 16 16" class="bi bi-people-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                              </svg>
                        </div>
                    </div>
                    <div class="mr-auto text-center sm:text-left mt-3 sm:mt-0">
                        <a href="" class="font-bolder text-black font-caps text-lg" tabindex="-1">კლიენტები</a> 
                        <div class="text-gray-600 mt-1 sm:mt-0 font-normal text-gray-700 text-xs">მოდელში მოცემულია ყველა კლიენტის რაოდენობა, დაჯავშნილი სერვისების რაოდენობა და სერვისებიდან გამომუშავებული თანხის რაოდენობა.</div>
                    </div>
                </div>
                <div class="grid mt-4 grid-cols-3">
                    <div class="col-span-1 flex items-center justify-center">
                            <div>
                                <h4 class="text-xl font-bolder">{{$clients['total']}}</h4>
                                <span class="font-normal text-xs">რაოდენობა</span>
                            </div>
                    </div>
                    <div class="col-span-1 flex items-center justify-center">
                            <div>
                                <h4 class="text-xl font-bolder">{{$clients['services']}}</h4>
                                <span class="font-normal text-xs">დაჯავშნილი</span>
                            </div>
                    </div>
                    <div class="col-span-1 flex items-center justify-center">
                            <div>
                                <h4 class="text-xl font-bolder">{{$clients['earn']}} <sup>₾</sup></h4>
                                <span class="font-normal text-xs">გამომუშავებული</span>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
    <script type="text/javascript">
    </script>
@endsection
