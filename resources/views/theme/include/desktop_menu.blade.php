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
                <div class="font-medium text-xs font-caps side-menu__title font-medium text-xs font-caps"> @lang('menu.home_page')</div>
            </a>
        </li>
       @if (auth()->user()->can('user'))
       <li>
        <a href="/showclients" class="side-menu side-menu--active" data-menu="home">
            <div class="side-menu__icon"> <i data-feather="home"></i> </div>
            <div class="font-medium text-xs font-caps side-menu__title font-medium text-xs font-caps"> @lang('menu.table') </div>
        </a>
    </li>
       @endif
        @if (auth()->user()->hasAnyPermission(['see_clients', 'add_clients', 'delete_clients','admin']))
        <li id="menuuser">
            <a href="javascript:;" class="side-menu" data-menu="user">
                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                <div class="font-medium text-xs font-caps side-menu__title font-medium text-xs font-caps"> @lang('menu.users') <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                @if (auth()->user()->can('admin'))
               <li>
                    <a href="{{ route('ActionUser') }}" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="font-normal text-xs side-menu__title"> @lang('menu.employees')  </div>
                    </a>
                </li>
            @endif
                <li>
                    <a href="/clients" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="font-normal text-xs side-menu__title"> @lang('menu.clients')  </div>
                    </a>
                </li>
                <li>
                    <a href="/groups" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="font-normal text-xs side-menu__title"> @lang('menu.groups') </div>
                    </a>
                </li>
                @if (auth()->user()->can('admin'))
                <li>
                    <a href="/roles" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="font-normal text-xs side-menu__title "> @lang('menu.roles') </div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif
        @if (auth()->user()->hasAnyPermission(['see_purchases', 'add_purchases', 'delete_purchases','admin']))
        <li id="menupurchases">
            <a href="javascript:;" class="side-menu" data-menu="purchases">
                <div class="side-menu__icon"> <i data-feather="archive"></i> </div>
                <div class="side-menu__title font-medium text-xs font-caps"> @lang('menu.purchase') <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="/purchases" class="side-menu custom-nav-item" data-menu="companies">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title font-normal text-xs">@lang('menu.purchases') </div>
                    </a>
                </li>
                
                @if (auth()->user()->hasAnyPermission(['see_products', 'add_product', 'delete_product','admin']))
                <li>
                    <a href="{{route('Warehouse')}}" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title font-normal text-xs"> @lang('menu.storage') </div>
                    </a>
                </li>
                <li>
                    <a href="{{route('WarehouseHistory')}}" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title font-normal text-xs"> @lang('menu.storage_history') </div>
                    </a>
                </li>
                    <li>
                        <a href="/companies/distcompany" class="side-menu custom-nav-item" data-menu="companies">
                            <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                            <div class="side-menu__title font-normal text-xs"> @lang('menu.distributors') </div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
        @endif
        
        @if (auth()->user()->hasAnyPermission(['see_services', 'add_service', 'delete_service','admin']))
        <li id="menuservices">
            <a href="javascript:;" class="side-menu" data-menu="services">
                <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                <div class="side-menu__title font-medium text-xs font-caps"> @lang('menu.service') <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="/services" class="side-menu custom-nav-item" data-menu="companies">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title font-normal text-xs">@lang('menu.services') </div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        @if (auth()->user()->hasAnyPermission(['see_company', 'add_company','delete_company','admin']))
        <li id="menucompanies">
            <a href="javascript:;" class="side-menu" data-menu="companies">
                <div class="side-menu__icon"> <i data-feather="box"></i> </div>
                <div class="side-menu__title font-medium text-xs font-caps"> @lang('menu.company') <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="/companies" class="side-menu custom-nav-item" data-menu="companies">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title font-normal text-xs"> @lang('menu.information') </div>
                    </a>
                </li>
                
               
            </ul>
        </li>
        @endif
        
        @if (auth()->user()->hasAnyPermission(['export_finances','admin']))
        <li id="menubugalteria">
            <a href="javascript:;" class="side-menu" data-menu="bugalteria">
                <div class="side-menu__icon"> <i data-feather="credit-card"></i> </div>
                <div class="side-menu__title font-medium text-xs font-caps"> @lang('menu.accounting') <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{route('Finances')}}" class="side-menu custom-nav-item" data-menu="departments">
                        <div class="side-menu__icon"><i data-feather="circle" style="width: 15px; height: 15px;"></i>
                        </div>
                        <div class="side-menu__title font-normal text-xs"> @lang('menu.finances')</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('StatisticController')}}" class="side-menu custom-nav-item" data-menu="departments">
                        <div class="side-menu__icon"><i data-feather="circle" style="width: 15px; height: 15px;"></i>
                        </div>
                        <div class="side-menu__title font-normal text-xs"> @lang('menu.salaries') </div>
                    </a>
                </li>
                <li>
                    <a href="/paymethods" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"><i data-feather="circle" style="width: 15px; height: 15px;"></i>
                        </div>
                        <div class="side-menu__title font-normal text-xs"> @lang('menu.pay_method')</div>
                    </a>
                </li>
                <li>
                    <a href="/vouchers" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"><i data-feather="circle" style="width: 15px; height: 15px;"></i>
                        </div>
                        <div class="side-menu__title font-normal text-xs"> @lang('menu.voucher')</div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        @if (auth()->user()->hasAnyPermission(['see_products', 'add_product', 'delete_product','admin']))
        <li id="menushop">
            <a href="javascript:;" class="side-menu" data-menu="shop">
                <div class="side-menu__icon"><i data-feather="shopping-cart"></i></div>
                <div class="side-menu__title font-medium text-xs font-caps"> @lang('menu.trade') <i data-feather="chevron-down"
                                                                 class="side-menu__sub-icon"></i></div>
            </a>
            <ul class="">
                <li>
                <a href="{{ route('AddToCart') }}" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title font-normal text-xs"> @lang('menu.new_sale') </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('Sales') }}" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title font-normal text-xs"> @lang('menu.sales') </div>
                    </a>
                </li>
                <li>
                    <a href="/products" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title font-normal text-xs"> @lang('menu.product') </div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        @if (auth()->user()->hasAnyPermission(['admin']))
        <li id="menusms">
            <a href="javascript:;" class="side-menu" data-menu="sms">
                <div class="side-menu__icon"><i data-feather="message-circle"></i></div>
                <div class="side-menu__title font-medium text-xs font-caps"> @lang('menu.marketing') <i data-feather="chevron-down"
                                                                 class="side-menu__sub-icon"></i></div>
            </a>
            <ul class="">
                <li>
                <a href="{{ route('sendSms') }}" class="side-menu custom-nav-item">
                        <div class="side-menu__icon"> <i data-feather="circle" style="width: 15px; height: 15px;"></i> </div>
                        <div class="side-menu__title font-normal text-xs"> @lang('menu.sms_send') </div>
                    </a>
                </li>
               
            </ul>
        </li>
        @endif
    </ul>
</nav>