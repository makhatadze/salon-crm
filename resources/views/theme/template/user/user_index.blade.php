@extends('theme.layout.layout')
@section('content')
    <h2 class="intro-y text-lg font-medium mt-10 font-helvetica">
        თანამშრომლები
    </h2>

    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2 user-header">
        <a href="{{ route('ActionUserAdd') }}" class="button text-white bg-theme-1 shadow-md mr-2 font-helvetica">ახალი
            მომხმარებლის რეგისტრაცია</a>
        <div class="hidden md:block mx-auto text-gray-600"></div>
        <div class="w-full sm:w-auto mt-3 mr-5 sm:mt-0 sm:ml-auto md:ml-0">
            <select class="w-20 input box mt-3 sm:mt-0" id="user-count">
                <option>25</option>
                <option>50</option>
                <option>75</option>
                <option>100</option>
            </select>
        </div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">

            <div class="w-56 relative text-gray-700">
                <input type="text" name="search" class="input w-56 box pr-10 placeholder-theme-13 font-helvetica"
                       placeholder="ძებნა...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6 mt-5 user-list">
        @foreach($users as $user)
            <div class="intro-y col-span-12 md:col-span-4">
                <div class="box">
                    <div class="flex flex-col lg:flex-row items-center p-5">
                        <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                            @if($user->image)
                                <img alt="" class="rounded-full" src="/storage/profile/{{$user->id}}/{{$user->image->name}}">
                            @else
                            <img alt="" class="rounded-full" src="/no-avatar.png">
                            @endif
                            
                        </div>
                        <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                            <a href="{{route('ShowUserProfile', $user->id)}}"class="font-bolder text-xs text-gray-700 uppercase font-caps">{{$user->profile->first_name .' '. $user->profile->last_name}}</a><br>
                            @if($user->profile)
                            @if($user->profile->salary > 0) <span class="text-xs font-normal">ხელფასი:  {{$user->profile->salary}} <sup>₾</sup></span> <br> @endif
                            <span class="text-xs font-normal">გამოიმუშავა: {{$user->getEarnedMoney() ? round($user->getEarnedMoney(), 2) : 0 }} <sup>₾</sup></span> <br>
                            @if($user->salary)
                                <span class="text-xs font-normal">
                                    ბოლო ხელფასი: 
                                    {{Carbon\Carbon::parse($user->created_at)->isoFormat('Y-MM-DD')}} 
                                </span>
                            @endif
                            @endif
                        </div>
                        <div class="flex mt-4 lg:mt-0">
                            @if ($user->profile)
                            
                        
                            <div class="flex">
                               @if ($user->isUser())
                               <a href="/user/export/{{$user->id}}" class="button button--sm bg-gray-200 text-gray-700 border border-gray-300 font-helvetica">
                                <svg width="1.4em" height="1.4em" viewBox="0 0 16 16" class="bi bi-file-arrow-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM8 5a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5A.5.5 0 0 1 8 5z"/>
                                  </svg>
                            </a>
                               @endif
                                <a href="{{route('ShowUserProfile', $user->id)}}" class="ml-1 button button--sm bg-gray-200 text-gray-700 border border-gray-300 font-helvetica">
                                    <svg width="1.4em" height="1.4em" viewBox="0 0 16 16" class="bi bi-file-earmark-text" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                        <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                                        <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                                      </svg>
                                </a>
                                <a data-toggle="modal" data-target="#salary_modal_{{$user->id}}" class="ml-1 button button--sm bg-gray-200 flex items-center justify-center text-gray-700 border border-gray-300 font-helvetica">
                                    <img src="{{asset('../img/salary.svg')}}" class="h-4 w-4 object-contain">
                                </a>
                            </div>
                            <div class="modal" id="salary_modal_{{$user->id}}">
                                <div class="modal__content modal__content--lg p-10 text-center"> 
                                    <form action="{{ route('giveSalary', $user->id) }}" method="POST">
                                        @csrf
                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                              <label class="text-left font-caps text-xs block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                                                ხელფასის ტიპი
                                              </label>
                                              <div class="relative">
                                                <select required onchange="salarytype(this.value)" name="salary_type" class="block appearance-none w-full bg-gray-200 font-normal text-xs border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
                                                  <option value="salary">სტანდარტული ხელფასი</option>
                                                  <option value="avansi">ავანსი</option>
                                                  <option value="other">სხვა თანხა</option>
                                                </select>
                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="w-full md:w-1/3 px-3">
                                                <label class="block uppercase tracking-wide text-left font-caps text-xs text-gray-700 text-xs font-bold mb-2">
                                                  რაოდენობა
                                                </label>
                                                <input required value="{{$user->profile->salary}}" name="salary" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" min="0" step="1">
                                            </div>
                                            <div class="w-full md:w-1/3 px-3">
                                                <label class="block uppercase tracking-wide text-left font-caps text-xs text-gray-700 text-xs font-bold mb-2">
                                                ბონუსი
                                                </label>
                                                <input required value="0" name="bonus" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" min="0" step="0.01">
                                            </div>
                                          </div>
                                          <div class="flex">
                                              
                                            <div class="w-full md:w-1/2" id="salaryreason">
                                                <label class="block uppercase tracking-wide text-left font-caps text-xs text-gray-700 text-xs font-bold mb-2">
                                                მიზეზი
                                                </label>
                                                <input name="reason" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" >
                                            </div>

                                            <div class="w-full md:w-1/2 px-3">
                                                <label class="block uppercase tracking-wide text-left font-caps text-xs text-gray-700 text-xs font-bold mb-2">
                                                გამოიმუშავა <small class="font-normal text-x">[დღეს]</small>
                                                </label>
                                                <input value="{{$user->getEarnedThisMoneth()}}" name="earn" class="font-normal text-xs appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" min="0" step="0.01">
                                            </div>
                                          </div>
                                          <div class="w-full flex justify-end">
                                            <button class="text-center  mt-3 py-2 px-4 bg-indigo-500 text-white font-bold text-xs font-caps">
                                                ატვირთვა
                                            </button>
                                          </div>
                                    </form>    
                                    @foreach ($user->salaries()->orderBy('id', 'desc')->get() as $salary)
                                    <hr class="my-2">
                                    <div class="w-full block">
                                        <div class="flex justify-between">
                                            <div class="text-left">
                                                <small class="font-normal text-gray-600 text-xs">ხელფასი: <span class="text-gray-800">{{$salary->salary/100}} <sup>₾</sup></span></small> <br>
                                                <small class="font-normal text-xs text-gray-600">ბონუსი: <span class="text-gray-800">{{$salary->bonus/100}} <sup>₾</sup></span></small> <br>
                                                <small class="font-normal text-xs text-gray-600">გამომუშავებული: <span class="text-gray-800">{{$salary->made_salary/100}} <sup>₾</sup></span></small>
                                            </div>
                                            <div class="text-right">
                                                <h6 class="font-normal text-xs text-gray-800">
                                                    @if ($salary->type == 'salary')
                                                        სტანდარტული ხელფასი
                                                        @elseif ($salary->type == 'avansi')
                                                        ავანსი
                                                        @elseif ($salary->type == 'other')
                                                        სხვა თანხა
                                                    @endif
                                                </h6>
                                                <h6 class="font-normal text-xs text-gray-800">{{$salary->created_at}}</h6>
                                            </div>
                                        </div>
                                        <p>{{$salary->reason}}</p>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="intro-y col-span-12 mt-4 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
        {{ $users->links('vendor.pagination.custom') }}
    </div>
@endsection
@section('custom_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.side-menu').removeClass('side-menu--active');
            $('.side-menu[data-menu="user"]').addClass('side-menu--active');
            $('#menuuser ul').addClass('side-menu__sub-open');
            $('#menuuser ul').css('display', 'block');
        });


        $('input[name ="search"]').change(function (e) {
                paintUsers();
        });

        $('#user-count').change(function (e) {
            paintUsers();
        });
        function paintUsers() {
            $.ajax({
                url: "{{route('ActionUser')}}",
                data: {
                    'searchValue': $('input[name ="search"]').val(),
                    'pagination': $('#user-count').val()
                }
            }).done(function (data) {
                if (data.length === 0) {
                    $('.user-list').html('<div class="vito">there is not user</div>');
                } else {
                    let content = '';
                    let users = data.data;
                    users.forEach(function (user) {
                        content = `${content}
                               <div class="intro-y col-span-12 md:col-span-6">
                                <div class="box">
                                    <div class="flex flex-col lg:flex-row items-center p-5">
                                        <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                                        <img alt="" class="rounded-full"
                                             src="${user['image'] ? '/storage/profile/' + user['id'] +'/'+ user['image']['name'] : '/no-avatar.png'}">
                                        </div>
                                        <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                                            <a href="" class="font-medium font-helvetica">${user['name']}</a>
                                        </div>
                                        <div class="flex mt-4 lg:mt-0">
                                            <a href="#" class="button button--sm text-gray-700 border border-gray-300 font-helvetica">პროფილი</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `
                    });
                    $('.user-list').html(content);

                }
            });
        }
    </script>
@endsection
