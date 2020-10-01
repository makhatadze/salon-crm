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
                        <div class="side-menu__title"> თანამშრომლები </div>
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
        @endif
        <li>
            <a href="javascript:;" class="side-menu" data-menu="purchases">
                <div class="side-menu__icon"> <i data-feather="archive"></i> </div>
                <div class="side-menu__title"> შესყიდვა <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="/purchases" class="side-menu custom-nav-item" data-menu="companies">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title">ჩამონათვალი </div>
                    </a>
                </li>
                <li>
                    <a href="{{route('Warehouse')}}" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title"> საწყობი </div>
                    </a>
                </li>
                <li>
                    <a href="/companies/distcompany" class="side-menu custom-nav-item" data-menu="companies">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title"> მომწოდებლები </div>
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
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu" data-menu="companies">
                <div class="side-menu__icon"> <i data-feather="credit-card"></i> </div>
                <div class="side-menu__title"> ბუღალტერია <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
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
                <div class="side-menu__title"> ვაჭრობა <i data-feather="chevron-down"
                                                                 class="side-menu__sub-icon"></i></div>
            </a>
            <ul class="">
                <li>
                <a href="{{ route('AddToCart') }}" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title"> ახალი გაყიდვა </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('Sales') }}" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title"> გაყიდვები </div>
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
                        <div class="side-menu__title"> ბრენდები </div>
                    </a>
                </li>
                <li>
                    <a href="/category" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"><i data-feather="circle" style="width: 15px; height: 15px;"></i>
                        </div>
                        <div class="side-menu__title"> კატეგორიები</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>