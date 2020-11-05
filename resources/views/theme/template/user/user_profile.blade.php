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
                <div class="font-bold text-sm "> {{$user->profile->first_name}} {{$user->profile->last_name}}</div>
                    <div class="text-gray-600 font-normal text-xs"> 
                        
                       {{ $user->getRoleNames()->first() == "user" ? __('profile.employee') : $user->getRoleNames()->first() }}
                    </div>
                </div>
                
            </div>
            <div class="p-5 border-t border-gray-200">
            <a class="flex items-center font-medium text-theme-1" @if($user->id != Auth::user()->id) href="/show/accountsettings/{{$user->id}}" @else href="/profile/accountsettings" @endif> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity w-4 h-4 mr-2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg> @lang('profile.job_table')</a>
                <a class="flex items-center mt-5  font-medium" @if($user->id != Auth::user()->id) href="/show/accountsettings/{{$user->id}}" @else href="/profile/accountsettings" @endif> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box w-4 h-4 mr-2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg> @lang('profile.Details') </a>
                @if($user->id == Auth::user()->id)
                    <a class="flex items-center mt-5 font-medium" href="/profile/changepassword"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock w-4 h-4 mr-2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> @lang('profile.password') </a>
                @endif
              </div>
              <div class="p-5 border-t border-gray-200 relative">
                <small class="bg-green-400 absolute top-0 right-0 p-1 font-bold text-x font-caps">სულ</small>
                <div class="flex">
                    <div class="w-1/3 p-3">
                        <h6 class="font-bold font-caps text-base text-black">{{ $user->getEarnedMoney() }} <sup>@lang('money.icon')</sup></h6>
                        <span class="font-normal text-xs">@lang('profile.earn')</span>
                    </div>
                    <div class="w-1/3 p-3">
                        <h6 class="font-bold font-caps text-base text-black">{{$user->ClientCount()}}</h6>
                        <span class="font-normal text-xs">@lang('profile.client')</span>
                    </div>
                    <div class="w-1/3 p-3">
                        <h6 class="font-bold font-caps text-base text-black"> {{$user->profile->salary}} <sup>@lang('money.icon')</sup></h6>
                        <span class="font-normal text-xs">@lang('profile.salary')</span>
                    </div>
                </div>
              </div>
            <div class="p-5 border-t flex items-center justify-center">
                @if ($user->active)
                <div class="flex items-center justify-center h-full font-normal text-xs">
                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-check-circle-fill mr-2" fill="#5dc78c" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                      </svg>@lang('profile.active')
                    </div>
                    @if ($user->id != Auth::user()->id)
                    <a href="/profile/turn/{{$user->id}}/0" class="button button--sm border text-gray-700 ml-auto font-bold font-caps text-xs">@lang('profile.on')</a>
                    @endif
                @else
                <div class="flex items-center justify-center h-full font-normal text-xs">
                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi mr-2 bi-dash-circle-fill" fill="#ff6155" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"></path>
                      </svg>@lang('profile.non_active')
                    </div>
                    @if ($user->id != Auth::user()->id)
               <a href="/profile/turn/{{$user->id}}/1" class="button button--sm border text-gray-700 ml-auto font-bold font-caps text-xs">@lang('profile.off')</a>
               @endif     
                @endif
            </div>
        </div>
        @if (auth()->user()->hasAnyPermission(['admin']))
        <div x-data="{modal: false}">
            <button @click="modal = true" class="my-2 p-2 bg-indigo-500 text-center text-white w-full font-bold text-xs ">
                @lang('profile.sms_send')
            </button>
                <x-modal x-show="modal" class="z-50">
                    <form action="{{ route('smsSendPost') }}" method="POST" class="bg-white mx-auto" autocomplete="off">
                        @csrf
                        <div class="w-full px-3 mb-2">
                        <label class=" block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                            <h6 class="font-caps">
                                @lang('profile.phone')
                            </h6> 
                        </label>
                        <input name="phone" value="{{$user->profile->phone}}" readonly required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" onkeyup="this.value = this.value.replace(/[^0-9\.]/g, '');" id="phone" type="text" minlength="9" maxlength="9" placeholder="555 11 22 33">
                        <small class="font-normal">@lang('profile.check_number')</small> 
                        @error('phone')
                            <p class="font-normal text-xs text-red-500">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                        <div class="w-full px-3">
                            <label class="font-caps block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="text">
                            @lang('profile.text')
                            </label>
                            <textarea name="text" id="text" cols="30" rows="5" class="appearance-none resize-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>
                            @error('text')
                                <p class="font-normal text-xs text-red-500">
                                    {{$message}}
                                </p>
                            @enderror
                        </div>
                        <div class="px-3 mt-2">
                            <button type="submit" class="w-full bg-indigo-500 py-3 px-4 text-white font-bold font-caps text-xs">@lang('profile.send')</button>
                        </div>
                    </form>
                </x-modal>
            </div>
        @endif
        <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8">
          <div class="intro-x flex items-center h-10">
              <h2 class="font-bolder text-sm font-caps truncate mr-5">
                @lang('profile.transactions')
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
                        @lang('profile.from_service')
                        @elseif($item->sale_id)
                        @lang('profile.from_sale')
                        @endif</div>
                        <div class="text-gray-600 text-xs">{{Carbon\Carbon::parse($item->created_at)->settings([
                            'toStringFormat' => 'jS \o\f F, Y',
                        ])}}</div>
                    </div>
                <div class="text-theme-9 font-normal">+{{round($item->service_price/100 * $item->percent/100, 2)}} <sup>@lang('money.icon')</sup></div>
                </div>
            </div>
            @empty
                
            @endforelse
             
          </div>
      </div>
    </div>
    {{-- End of Profile --}}
    <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
      <div class="mt-4">
        <livewire:user.profile :getuser="$user" />
      </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script>
      $(document).ready(function () {
            $('.side-menu').removeClass('side-menu--active');
            $('.side-menu[data-menu="user"]').addClass('side-menu--active');
            $('#menuuser ul').addClass('side-menu__sub-open');
            $('#menuuser ul').css('display', 'block');
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
                                <h6 class="font-bold">`+client['serviceprice']+` <sup>@lang('money.icon')</sup></h6>
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