<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{ url('theme/images/logo.svg') }}">
        <span class="hidden xl:block text-white text-lg ml-3"> CRM<span class="font-medium"> DIMOND</span> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="/" class="side-menu side-menu--active" data-menu="home">
                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                <div class="side-menu__title"> მთავარი გვერდი </div>
            </a>
        </li>
        @if(auth()->user()->isAdministrator())
        <li>
            <a href="javascript:;" class="side-menu" data-menu="user">
                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                <div class="side-menu__title"> მომხმარებლები <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{ route('ActionUser') }}" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title"> ჩამონათვალი </div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        <li>
            <a href="javascript:;" class="side-menu" data-menu="news">
                <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                <div class="side-menu__title"> სიახლეები <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="#" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title"> ჩამონათვალი </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu" data-menu="purchases">
                <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                <div class="side-menu__title"> შესყიდვა <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="/purchases" class="side-menu custom-nav-item" data-menu="companies">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title">ჩამონათვალი </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu" data-menu="services">
                <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                <div class="side-menu__title"> სერვისები <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="/services" class="side-menu custom-nav-item" data-menu="companies">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title">ჩამონათვალი </div>
                    </a>
                </li>
                <li>
                    <a href="/clients" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title"> კლიენტები </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu" data-menu="companies">
                <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                <div class="side-menu__title"> კომპანია <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="/companies" class="side-menu custom-nav-item" data-menu="companies">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title"> კომპანიები </div>
                    </a>
                </li>
                <li>
                    <a href="/companies/distcompany" class="side-menu custom-nav-item" data-menu="companies">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title"> სადისტრიბუციო </div>
                    </a>
                </li>
                <li>
                    <a href="/companies/offices" class="side-menu custom-nav-item" data-menu="offices">
                        <div class="side-menu__icon"><i data-feather="circle" style="width: 15px; height: 15px;"></i>
                        </div>
                        <div class="side-menu__title"> ოფისები</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('Departments')}}" class="side-menu custom-nav-item" data-menu="departments">
                        <div class="side-menu__icon"><i data-feather="circle" style="width: 15px; height: 15px;"></i>
                        </div>
                        <div class="side-menu__title"> დეპარტამენტები</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('Finances')}}" class="side-menu custom-nav-item" data-menu="departments">
                        <div class="side-menu__icon"><i data-feather="circle" style="width: 15px; height: 15px;"></i>
                        </div>
                        <div class="side-menu__title"> ფინანსები</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('MoneyController')}}" class="side-menu custom-nav-item" data-menu="departments">
                        <div class="side-menu__icon"><i data-feather="circle" style="width: 15px; height: 15px;"></i>
                        </div>
                        <div class="side-menu__title"> თანხის ბრუნვა</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('StatisticController')}}" class="side-menu custom-nav-item" data-menu="departments">
                        <div class="side-menu__icon"><i data-feather="circle" style="width: 15px; height: 15px;"></i>
                        </div>
                        <div class="side-menu__title"> სტატისტიკა</div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu" data-menu="shop">
                <div class="side-menu__icon"><i data-feather="shopping-cart"></i></div>
                <div class="side-menu__title"> ონლაინ მაღაზია <i data-feather="chevron-down"
                                                                 class="side-menu__sub-icon"></i></div>
            </a>
            <ul class="">
                <li>
                    <a href="index.html" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title"> შეკვეთები </div>
                    </a>
                </li>
                <li>
                    <a href="/products" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title"> პროდუქცია </div>
                    </a>
                </li>
                <li>
                    <a href="top-menu-dashboard.html" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title"> დამატებითი ველები </div>
                    </a>
                </li>
                <li>
                    <a href="top-menu-dashboard.html" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title"> ბრენდები </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu" data-menu="settings">
                <div class="side-menu__icon"> <i data-feather="settings"></i> </div>
                <div class="side-menu__title"> პარამეტრები <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="/options" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title"> პარამეტრები </div>
                    </a>
                </li>
                <li>
                    <a href="/categories" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title"> კატეგორიები </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title"> საიტის პარამეტრები </div>
                    </a>
                </li>
                <li>
                    <a href="simple-menu-dashboard.html" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title"> სტატიკური გვერდები </div>
                    </a>
                </li>
            </ul>
            
        </li><a href="/logout" class="absolute bottom-0 flex justify-center text-white items-center font-medium font-caps">
            <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-door-open" fill="#fff" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M1 15.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5zM11.5 2H11V1h.5A1.5 1.5 0 0 1 13 2.5V15h-1V2.5a.5.5 0 0 0-.5-.5z"/>
                <path fill-rule="evenodd" d="M10.828.122A.5.5 0 0 1 11 .5V15h-1V1.077l-6 .857V15H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117z"/>
                <path d="M8 9c0 .552.224 1 .5 1s.5-.448.5-1-.224-1-.5-1-.5.448-.5 1z"/>
              </svg><span class="ml-1">გასვლა</span></a>
    </ul>
</nav>