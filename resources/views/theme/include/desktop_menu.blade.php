<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{ url('theme/images/logo.svg') }}">
        <span class="hidden xl:block text-white text-lg ml-3"> CRM<span class="font-medium"> DIMOND</span> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li >
            <a href="/" class="side-menu side-menu--active" data-menu="home">
                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                <div class="font-medium text-xs font-caps side-menu__title font-medium text-xs font-caps"> მთავარი გვერდი </div>
            </a>
        </li>
       @if (auth()->user()->can('user'))
       <li>
        <a href="/showclients" class="side-menu side-menu--active" data-menu="home">
            <div class="side-menu__icon"> <i data-feather="home"></i> </div>
            <div class="font-medium text-xs font-caps side-menu__title font-medium text-xs font-caps"> ცხრილი </div>
        </a>
    </li>
       @endif
        @if (auth()->user()->hasAnyPermission(['see_clients', 'add_clients', 'delete_clients','admin']))
        <li>
            <a href="javascript:;" class="side-menu" data-menu="user">
                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                <div class="font-medium text-xs font-caps side-menu__title font-medium text-xs font-caps"> მომხმარებლები <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                @if (auth()->user()->can('admin'))
               <li>
                <a href="{{ route('ActionUser') }}" class="side-menu custom-nav-item">
                    <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                    <div class="font-normal text-xs side-menu__title"> თანამშრომლები </div>
                </a>
            </li>
            @endif
                <li>
                    <a href="/clients" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="font-normal text-xs side-menu__title"> კლიენტები </div>
                    </a>
                </li>
                @if (auth()->user()->can('admin'))
                <li>
                    <a href="/roles" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="font-normal text-xs side-menu__title "> როლები </div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if (auth()->user()->hasAnyPermission(['see_purchases', 'add_purchases', 'delete_purchases','admin']))
        <li>
            <a href="javascript:;" class="side-menu" data-menu="purchases">
                <div class="side-menu__icon"> <i data-feather="archive"></i> </div>
                <div class="side-menu__title font-medium text-xs font-caps"> შესყიდვა <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="/purchases" class="side-menu custom-nav-item" data-menu="companies">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title font-normal text-xs">ჩამონათვალი </div>
                    </a>
                </li>
                
                @if (auth()->user()->hasAnyPermission(['see_products', 'add_product', 'delete_product','admin']))
                    <li>
                        <a href="{{route('Warehouse')}}" class="side-menu custom-nav-item">
                            <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                            <div class="side-menu__title font-normal text-xs"> საწყობი </div>
                        </a>
                    </li>
                    <li>
                        <a href="/companies/distcompany" class="side-menu custom-nav-item" data-menu="companies">
                            <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                            <div class="side-menu__title font-normal text-xs"> მომწოდებლები </div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
        @endif
        
        @if (auth()->user()->hasAnyPermission(['see_services', 'add_service', 'delete_service','admin']))
        <li>
            <a href="javascript:;" class="side-menu" data-menu="services">
                <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                <div class="side-menu__title font-medium text-xs font-caps"> სერვისები <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="/services" class="side-menu custom-nav-item" data-menu="companies">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title font-normal text-xs">ჩამონათვალი </div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        @if (auth()->user()->hasAnyPermission(['see_company', 'add_company','delete_company','admin']))
        <li>
            <a href="javascript:;" class="side-menu" data-menu="companies">
                <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                <div class="side-menu__title font-medium text-xs font-caps"> კომპანია <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="/companies" class="side-menu custom-nav-item" data-menu="companies">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title font-normal text-xs"> კომპანიები </div>
                    </a>
                </li>
                
                <li>
                    <a href="/companies/offices" class="side-menu custom-nav-item" data-menu="offices">
                        <div class="side-menu__icon"><i data-feather="circle" style="width: 15px; height: 15px;"></i>
                        </div>
                        <div class="side-menu__title font-normal text-xs"> ოფისები</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('Departments')}}" class="side-menu custom-nav-item" data-menu="departments">
                        <div class="side-menu__icon"><i data-feather="circle" style="width: 15px; height: 15px;"></i>
                        </div>
                        <div class="side-menu__title font-normal text-xs"> დეპარტამენტები</div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        
        @if (auth()->user()->can('export_finances'))
        <li>
            <a href="javascript:;" class="side-menu" data-menu="bugalteria">
                <div class="side-menu__icon"> <i data-feather="credit-card"></i> </div>
                <div class="side-menu__title font-medium text-xs font-caps"> ბუღალტერია <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{route('Finances')}}" class="side-menu custom-nav-item" data-menu="departments">
                        <div class="side-menu__icon"><i data-feather="circle" style="width: 15px; height: 15px;"></i>
                        </div>
                        <div class="side-menu__title font-normal text-xs"> ფინანსები</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('MoneyController')}}" class="side-menu custom-nav-item" data-menu="departments">
                        <div class="side-menu__icon"><i data-feather="circle" style="width: 15px; height: 15px;"></i>
                        </div>
                        <div class="side-menu__title font-normal text-xs"> თანხის ბრუნვა</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('StatisticController')}}" class="side-menu custom-nav-item" data-menu="departments">
                        <div class="side-menu__icon"><i data-feather="circle" style="width: 15px; height: 15px;"></i>
                        </div>
                        <div class="side-menu__title font-normal text-xs"> სტატისტიკა</div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        @if (auth()->user()->hasAnyPermission(['see_products', 'add_product', 'delete_product','admin']))
        <li>
            <a href="javascript:;" class="side-menu" data-menu="shop">
                <div class="side-menu__icon"><i data-feather="shopping-cart"></i></div>
                <div class="side-menu__title font-medium text-xs font-caps"> ვაჭრობა <i data-feather="chevron-down"
                                                                 class="side-menu__sub-icon"></i></div>
            </a>
            <ul class="">
                <li>
                <a href="{{ route('AddToCart') }}" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title font-normal text-xs"> ახალი გაყიდვა </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('Sales') }}" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title font-normal text-xs"> გაყიდვები </div>
                    </a>
                </li>
                <li>
                    <a href="/products" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title font-normal text-xs"> პროდუქცია </div>
                    </a>
                </li>
                <li>
                    <a href="/brands" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title font-normal text-xs"> ბრენდები </div>
                    </a>
                </li>
                <li>
                    <a href="/category" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"><i data-feather="circle" style="width: 15px; height: 15px;"></i>
                        </div>
                        <div class="side-menu__title font-normal text-xs"> კატეგორიები</div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
    </ul>
</nav>