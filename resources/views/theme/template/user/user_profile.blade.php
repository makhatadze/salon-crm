@extends('theme.layout.layout')
@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
        <div class="intro-y box mt-5">
            <div class="relative flex items-center p-5">
                <div class="w-12 h-12 image-fit">
                    @if ($user->image()->first())
                    <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="dist/images/profile-14.jpg">
                    @else
                    <img alt="" class="rounded-full" src="/no-avatar.png">
                    @endif
                </div>
                <div class="ml-4 mr-auto">
                <div class="font-bold text-sm "> {{$user->profile()->first()->first_name}} {{$user->profile()->first()->last_name}}</div>
                    <div class="text-gray-600 font-normal text-xs"> 
                        @if ($user->isUser())
                            სტილისტი
                        @endif
                    </div>
                </div>
                <div class="dropdown relative">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal w-5 h-5 text-gray-700"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg> </a>
                    <div class="dropdown-box mt-5 absolute w-56 top-0 right-0 z-20">
                        <div class="dropdown-box__content box">
                            <div class="p-4 border-b border-gray-200 font-medium">Export Options</div>
                            <div class="p-2">
                                <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity w-4 h-4 text-gray-700 mr-2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> English </a>
                                <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box w-4 h-4 text-gray-700 mr-2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg> Indonesia 
                                    <div class="text-xs text-white px-1 rounded-full bg-theme-6 ml-auto">10</div>
                                </a>
                                <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout w-4 h-4 text-gray-700 mr-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg> English </a>
                                <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sidebar w-4 h-4 text-gray-700 mr-2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="3" x2="9" y2="21"></line></svg> Indonesia </a>
                            </div>
                            <div class="px-3 py-3 border-t border-gray-200 font-medium flex">
                                <button type="button" class="button button--sm bg-theme-1 text-white">Settings</button>
                                <button type="button" class="button button--sm bg-gray-200 text-gray-600 ml-auto">View Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-5 border-t border-gray-200">
                <a class="flex items-center text-theme-1 font-medium" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity w-4 h-4 mr-2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> სამუშაო ცხრილი </a>
                <a class="flex items-center mt-5" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box w-4 h-4 mr-2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg> Account Settings </a>
                <a class="flex items-center mt-5" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock w-4 h-4 mr-2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> Change Password </a>
                <a class="flex items-center mt-5" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings w-4 h-4 mr-2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg> User Settings </a>
            </div>
            <div class="p-5 border-t border-gray-200">
                <div class="flex">
                    <div class="w-1/2 p-2">
                        <h6 class="font-bold font-caps text-xl text-black">{{$user->getEarnedMoney()}} <sup>₾</sup></h6>
                        <span class="font-normal text-xs">გამომუშავებული</span>
                    </div>
                    <div class="w-1/2 p-2">
                        <h6 class="font-bold font-caps text-xl text-black">{{$user->ClientCount()}}</h6>
                        <span class="font-normal text-xs">კლიენი</span>
                    </div>
                </div>
            </div>
            <div class="p-5 border-t flex items-center justify-center">
                @if ($user->active)
                <div class="flex items-center justify-center h-full font-normal text-xs">
                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-check-circle-fill mr-2" fill="#5dc78c" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                      </svg>აქტიური
                    </div>
                    
                <a href="/profile/turn/0" class="button button--sm border text-gray-700 ml-auto font-bold font-caps text-xs">გათიშვა</a>
                @else
                <div class="flex items-center justify-center h-full font-normal text-xs">
                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi mr-2 bi-dash-circle-fill" fill="#ff6155" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"></path>
                      </svg>არა აქტიური
                    </div>
                    
                <a href="/profile/turn/1" class="button button--sm border text-gray-700 ml-auto font-bold font-caps text-xs">ჩართვა</a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto">
                    კლიენტების სია
                </h2>
                <select class="slect2" id="clientfilter">
                    <option value="all">ყველა</option>
                    <option value="done">მიღებული</option>
                    <option value="waiting">ველოდებით</option>
                    <option value="notcome">არ მოსულა</option>
                </select>    
            </div>
            <div class="p-5" id="clientlist">
                @foreach ($userclients as $client)
                <div class="grid grid-cols-4 my-3">
                    <div class="col-span-1 ">
                    <h6 class="font-bold text-gray-800">{{$client->clinetserviceable()->first()->{'full_name_'.app()->getLocale()} }}</h6>
                    <span class="text-sm text-gray-700 font-normal">{{$client->clinetserviceable()->first()->number}}</span>
                    </div>
                    <div class="col-span-1 font-normal">
                        <span class="text-xs">დან: </span>{{$client->session_start_time}} <br>
                        <span class="text-xs">მდე: </span>{{$client->getEndTime()}}
                    </div>
                    <div class="col-span-1 ">
                    <h6 class="font-bold">{{$client->getServicePrice()}} <sup>₾</sup></h6>
                        <span class="font-normal">{{$client->getServiceName()}}</span>
                    </div>
                    <div class="col-span-1 flex align-center justify-center">
                        @if ($client->status)
                        <div class="flex items-center justify-center h-full font-normal text-xs">
                            <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-check-circle-fill mr-2" fill="#5dc78c" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                              </svg>მიღებულია
                            </div>
                          @elseif(Carbon\Carbon::now() < $client->session_start_time)
                        <div class="flex items-center justify-center h-full font-normal text-xs">
                            <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi mr-2 bi-slash-circle-fill" fill="#ffb52d" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.646-2.646a.5.5 0 0 0-.708-.708l-6 6a.5.5 0 0 0 .708.708l6-6z"></path>
                              </svg>
                              ველოდებით
                        </div>
                        @elseif(Carbon\Carbon::now() > $client->session_start_time)
                        <div class="flex items-center justify-center h-full font-normal text-xs">
                            <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi mr-2 bi-dash-circle-fill" fill="#ff6155" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"></path>
                              </svg>არ მოსულა
                            </div>
                        @endif
                    </div>
                </div> 
                <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script>
      $(document).ready(function () {
            $('.side-menu').removeClass('side-menu--active');
            $('.side-menu[data-menu="user"]').addClass('side-menu--active');
            $('#clientfilter').select2();
            $("#clientfilter").change(function() {
                $value = $('#clientfilter').val();
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                  url: "{{ route('ProfileFilter') }}",
                  method: 'post',
                  data: {
                     'filter': $value,
                  },
                  success: function(result){
                    if(result.status == true){
                        $html = '';
                        $data = result.data;
                        $data.forEach(function (client){
                        $dt = new Date('{{Carbon\Carbon::now()}}');
                        $st = new Date(client['session_start_time']);
                        $mark = '';
                            if(client['status'] == true){
                                $mark = `<div class="flex items-center justify-center h-full font-normal text-xs">
                                        <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-check-circle-fill mr-2" fill="#5dc78c" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                        </svg>მიღებულია
                                        </div>`;
                            }else if($dt.getTime() < $st.getTime()){
                                $mark = `
                                <div class="flex items-center justify-center h-full font-normal text-xs">
                                        <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi mr-2 bi-slash-circle-fill" fill="#ffb52d" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.646-2.646a.5.5 0 0 0-.708-.708l-6 6a.5.5 0 0 0 .708.708l6-6z"></path>
                                        </svg>
                                        ველოდებით
                                    </div>
                                `;
                            }else if($dt.getTime() > $st.getTime()){
                                $mark = `
                                <div class="flex items-center justify-center h-full font-normal text-xs">
                                        <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi mr-2 bi-dash-circle-fill" fill="#ff6155" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"></path>
                                        </svg>არ მოსულა
                                        </div>`;
                            }
                            $html += `
                            <div class="grid grid-cols-4 my-3">
                                <div class="col-span-1 ">
                                <h6 class="font-bold text-gray-800">`+client['clientname']+`</h6>
                                <span class="text-sm text-gray-700 font-normal">`+client['clientnumber']+`</span>
                                </div>
                                <div class="col-span-1 font-normal">
                                    <span class="text-xs">დან: </span>`+client['session_start_time']+`<br>
                                    <span class="text-xs">მდე: </span>`+client['endtime']+`
                                </div>
                                <div class="col-span-1 ">
                                <h6 class="font-bold">`+client['serviceprice']+` <sup>₾</sup></h6>
                                    <span class="font-normal">`+client['servicename']+`</span>
                                </div>
                                <div class="col-span-1 flex align-center justify-center">
                                   `+$mark+`
                                    
                                </div>
                            </div> 
                            <hr>
                            `;
                        });
                        $('#clientlist').html('');
                        $('#clientlist').html($html);
                    }
                  }
                });


            });
      });
</script>
@endsection