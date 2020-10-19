@extends('theme.layout.layout')
@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
        <div class="intro-y box mt-5">
            <div class="relative flex items-center p-5">
                <div class="w-12 h-12 image-fit">
                  @if ($user->image()->first())
                  <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{asset('../storage/profile/'.$user->id.'/'.$user->image()->first()->name)}}">
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
            </div>
            <div class="p-5 border-t border-gray-200">
            <a class="flex items-center font-medium text-theme-1" @if($user->id != Auth::user()->id) href="/show/accountsettings/{{$user->id}}" @else href="/profile/accountsettings" @endif> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity w-4 h-4 mr-2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> სამუშაო ცხრილი </a>
                <a class="flex items-center mt-5  font-medium" @if($user->id != Auth::user()->id) href="/show/accountsettings/{{$user->id}}" @else href="/profile/accountsettings" @endif> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box w-4 h-4 mr-2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg> ანგარიშის დეტალები </a>
                @if($user->id == Auth::user()->id)
                    <a class="flex items-center mt-5 font-medium" href="/profile/changepassword"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock w-4 h-4 mr-2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> პაროლის შეცვლა </a>
                @endif
              </div>
              <div class="p-5 border-t border-gray-200 relative">
                <small class="bg-green-400 absolute top-0 right-0 p-1 font-bold text-x font-caps">სულ</small>
                <div class="flex">
                    <div class="w-1/3 p-3">
                        <h6 class="font-bold font-caps text-base text-black">{{ $user->getEarnedMoney() }} <sup>₾</sup></h6>
                        <span class="font-normal text-xs">გამომუშავებული</span>
                    </div>
                    <div class="w-1/3 p-3">
                        <h6 class="font-bold font-caps text-base text-black">{{$user->ClientCount()}}</h6>
                        <span class="font-normal text-xs">კლიენი</span>
                    </div>
                    <div class="w-1/3 p-3">
                        <h6 class="font-bold font-caps text-base text-black"> {{$user->profile()->first()->salary}} <sup>₾</sup></h6>
                        <span class="font-normal text-xs">ხელფასი</span>
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
                    @if ($user->id != Auth::user()->id)
                    <a href="/profile/turn/{{$user->id}}/0" class="button button--sm border text-gray-700 ml-auto font-bold font-caps text-xs">გათიშვა</a>
                    @endif
                @else
                <div class="flex items-center justify-center h-full font-normal text-xs">
                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi mr-2 bi-dash-circle-fill" fill="#ff6155" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"></path>
                      </svg>არა აქტიური
                    </div>
                    @if ($user->id != Auth::user()->id)
               <a href="/profile/turn/{{$user->id}}/1" class="button button--sm border text-gray-700 ml-auto font-bold font-caps text-xs">ჩართვა</a>
               @endif     
                @endif
            </div>
        </div>
        <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8">
          <div class="intro-x flex items-center h-10">
              <h2 class="font-bolder text-sm font-caps truncate mr-5">
                  ტრანსაქციები
              </h2>
          </div>
          <div class="mt-5">

            {{-- Transactions --}}
            @forelse ($user->transacrions() as $item)
            <div class="intro-x">
                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                    <div class="w-10 h-10 flex bg-gray-300 font-bolder items-center justify-center image-fit rounded-full overflow-hidden">
                        {{$item->percent}} <sub>%</sub>
                    </div>
                    <div class="ml-4 mr-auto">
                    <div class="font-medium">
                        @if ($item->service_id)
                        სერვისიდან
                        @elseif($item->sale_id)
                        გაყიდვიდან
                        @endif</div>
                        <div class="text-gray-600 text-xs">{{Carbon\Carbon::parse($item->created_at)->settings([
                            'toStringFormat' => 'jS \o\f F, Y',
                        ])}}</div>
                    </div>
                <div class="text-theme-9 font-normal">+{{round($item->service_price/100 * $item->percent/100, 2)}} <sup>₾</sup></div>
                </div>
            </div>
            @empty
                
            @endforelse
             
          </div>
      </div>
    </div>
    {{-- End of Profile --}}
    <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                   
                <form class="flex">
                    <input name="date" @if(isset($queries['date'])) value="{{$queries['date']}}" @endif data-daterange="true" class="datepicker font-normal text-xs input appearance-none block w-full md:w-56 mr-3 bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"> 
           
                    <div class="relative w-full md:w-56">
                        <select name="status"  class="block font-normal text-xs appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                          <option value="">ყველა</option>
                          <option value="true" @if(isset($queries['status']) && $queries['status'] == "true") selected @endif>მიღებული</option>
                          <option value="false" @if(isset($queries['status']) && $queries['status'] == "false") selected @endif>არ მოსულა ან ველოდებით</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 -mt-3 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                      <div class="flex w-full md:w-56 ml-3 h-10">
                        <button class="w-3/4 block appearance-none font-bold font-caps bg-indigo-500 text-xs text-white bg-gray-200 border border-gray-200  py-2 px-4 rounded leading-tight">
                            ძებნა
                          </button>   
                          <a href="{{url()->current()}}" class="w-1/4  block appearance-none flex items-center justify-center font-bold font-caps bg-red-500 text-xs text-white bg-gray-200 border border-gray-200  py-3 px-4  rounded leading-tight">
                            <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-x-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                              </svg>
                            </a>   
                    </div>
                </form>
            </div>
            <div class="p-5" id="clientlist">
               @if($userclients)
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
                   <h6 class="font-bold">{{$client->service->price/100}} <sup>₾</sup></h6>
                       <span class="font-normal">{{$client->service->{"title_".app()->getLocale()}}}</span>
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
               {{$userclients->links()}}
               @endif
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
                     'userid': '{{$user->id}}',
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