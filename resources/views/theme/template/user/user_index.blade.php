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
                            <a @if ($user->profile) href="{{route('ShowUserProfile', $user->id)}}" @endif class="font-bolder text-xs text-gray-700 uppercase font-caps">{{$user->name}} @if($user->profile()->first()) {{$user->profile()->first()->last_name}} @endif</a><br>
                            @if($user->profile()->first())
                            <span class="text-xs font-normal">ხელფასი: {{$user->profile()->first()->salary}} <sup>₾</sup></span> <br>
                            <span class="text-xs font-normal">გამოიმუშავა: {{$user->getEarnedMoney() ? round($user->getEarnedMoney(), 2) : 0 }} <sup>₾</sup></span> <br>
                            <span class="text-xs font-normal">მოვიდა: {{Carbon\Carbon::parse($user->created_at)->isoFormat('Y-MM-DD')}}</span>
                            @endif
                        </div>
                        <div class="flex mt-4 lg:mt-0">
                            @if ($user->profile()->first())
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
        });


        $('input[name ="search"]').change(function (e) {
                paintUsers();
        })

        $('#user-count').change(function (e) {
            paintUsers();
        })

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
