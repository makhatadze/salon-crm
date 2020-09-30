<div>
    <div class="top-bar">
        @include('partials._breadcrumbs')
        <a class="p-1 bg-white rounded-full mr-3 cursor-pointer relative" href="javascript:;" data-toggle="modal" data-target="#cart-modal">
            <div class="h-4 w-4 text-white rounded-full bg-red-500 absolute top-0 -mr-1 flex items-center justify-center -mt-1 right-0 text-xs font-bold"> 0</div>
            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-basket2-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383L5.93 1.757zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm4-1a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1z"/>
              </svg>
            </a>
        <div class="intro-x dropdown w-8 h-8 relative">
            
            <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                @if(Auth()->user()->image)
                    <img alt="Midone Tailwind HTML Admin Template"
                         src="/storage/profile/{{Auth()->user()->id}}/{{Auth()->user()->image->name}}">
                @else
                    <img alt="" class="rounded-full" src="/no-avatar.png">

                @endif
            </div>
            <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                <div class="dropdown-box__content box bg-theme-38 text-white">
                    <div class="p-4 border-b border-theme-40">
                        @if(Auth()->user()->profile)
                            <div class="font-medium">{{Auth()->user()->profile->first_name}} {{Auth()->user()->profile->last_name}}</div>
                        @else
                            <div class="font-medium">{{Auth()->user()->name}}</div>
                        @endif
                        {{--                            <div class="text-xs text-theme-41">{{Auth()->user()->profile->position}}</div>--}}
                    </div>
                    <div class="p-2">
                        <a href=""
                           class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-user w-4 h-4 mr-2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Profile </a>
                        <a href=""
                           class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-edit w-4 h-4 mr-2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Add Account </a>
                        <a href=""
                           class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-lock w-4 h-4 mr-2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            Reset Password </a>
                        <a href=""
                           class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-help-circle w-4 h-4 mr-2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                                <line x1="12" y1="17" x2="12.01" y2="17"></line>
                            </svg>
                            Help </a>
                    </div>
                    <div class="p-2 border-t border-theme-40">
                        <a href="/logout"
                           class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-toggle-right w-4 h-4 mr-2">
                                <rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect>
                                <circle cx="16" cy="12" r="3"></circle>
                            </svg>
                            Logout </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Account Menu -->
    </div>
    {{-- Cart Modal Start --}}
    <div class="modal overflow-y-auto" id="cart-modal" style="margin-top: 0px; margin-left: 0px; padding-left: 0px; z-index: 51;">
        <div class="modal__content">
            <div class="p-5 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle w-16 h-16 text-theme-6 mx-auto mt-3"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg> 
                <div class="text-3xl mt-5">Are you sure?</div>
                <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.</div>
            </div>
            <div class="px-5 pb-8 text-center">
                <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                <button type="button" class="button w-24 bg-theme-6 text-white">Delete</button>
            </div>
        </div>
    </div>
</div>