@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 lg:col-span-4 xl:col-span-3">
        <div class="box mt-5 p-5">
        <form @if (isset($role)) action="{{ route('UpdateRole', $role->id) }}" @else action="{{ route('AddRole') }}" @endif method="POST">
            @csrf
                <div class="w-full">
                    <input
                     class="appearance-none font-bold text-xs block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       type="text"
                       name="rolename"
                       required
                @if(isset($role)) value="{{$role->name}}" @endif
                       placeholder="როლის სახელი">
                  </div>
                  @error('rolename')
                    <p class="text-xs font-normal ">{{ $message }}</p>
                  @enderror
                {{-- Users --}}
                <div class="p-2">
                    <div class="flex items-center font-bold text-gray-700 text-xs mt-1"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box w-4 h-4 mr-2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> 
                        მომხმარებლები 
                    </div>
                    <div class="mt-3 flex justify-between items-center font-normal text-xs">
                     <div class="flex  items-center">
                         <input type="checkbox" name="see_users" id="see_users" class="mr-3">
                        <label for="see_users"> ნახვა</label>
                     </div>
                     <div class="flex  items-center">
                         <input type="checkbox" name="add_user" id="add_user" class="mr-3">
                         <label for="add_user">დამატება & რედაქტირება</label>
                     </div>
                     <div class="flex items-center">
                         <input type="checkbox" name="delete_user" id="delete_user" class="mr-3">
                         <label for="delete_user">წაშლა</label>
                     </div>
                    </div>
                </div>
                
                {{-- Service --}}
                <div class="p-2">
                    <span class="flex items-center font-bold text-gray-700 text-xs mt-1"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box w-4 h-4 mr-2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg> 
                        სერვისი 
                    </span>
                    <div class="mt-3 flex justify-between items-center font-normal text-xs">
                     <div class="flex  items-center">
                         <input type="checkbox" name="see_service" id="see_service" class="mr-3">
                         <label for="see_service">ნახვა</label>
                     </div>
                     <div class="flex  items-center">
                         <input type="checkbox" name="add_service" id="add_service" class="mr-3">
                         <label for="add_service">დამატება & რედაქტირება</label>
                     </div>
                     <div class="flex items-center">
                         <input type="checkbox" name="delete_service" id="delete_service" class="mr-3">
                         <label for="delete_service">წაშლა</label>
                     </div>
                    </div>
                </div>
    
                {{-- Product --}}
                <div class="p-2">
                    <div class="flex items-center font-bold text-gray-700 text-xs mt-1"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box w-4 h-4 mr-2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        პროდუქტი 
                    </div>
                    <div class="mt-3 flex justify-between items-center font-normal text-xs">
                     <div class="flex  items-center">
                         <input type="checkbox" @if (isset($role) && $role->checkPermission('see_product')) checked @endif name="see_products" id="see_products" class="mr-3">
                         <label for="see_product">ნახვა</label>
                     </div>
                     <div class="flex  items-center">
                         <input type="checkbox" @if (isset($role) && $role->checkPermission('add_product')) checked @endif name="add_product" id="add_product" class="mr-3">
                         <label for="add_product">დამატება & რედაქტირება</label>
                     </div>
                     <div class="flex items-center">
                         <input type="checkbox" name="delete_product" @if (isset($role) && $role->checkPermission('delete_product')) checked @endif id="delete_product" class="mr-3">
                         <label for="delete_product">წაშლა</label>
                     </div>
                    </div>
                </div>
                
                {{-- Purchases --}}
                <div class="p-2">
                    <span class="flex items-center font-bold text-gray-700 text-xs mt-1"> 
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box w-4 h-4 mr-2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                        შესყიდვები 
                    </span>
                    <div class="mt-3 flex justify-between items-center font-normal text-xs">
                     <div class="flex  items-center">
                         <input type="checkbox" name="see_purchases" @if (isset($role) && $role->checkPermission('see_purchases')) checked @endif  id="see_purchases" class="mr-3">
                         <label for="see_purchases">ნახვა</label>
                     </div>
                     <div class="flex  items-center">
                         <input type="checkbox" name="add_purchase" @if (isset($role) && $role->checkPermission('add_purchase')) checked @endif  id="add_purchase" class="mr-3">
                         <label for="add_purchase">დამატება & რედაქტირება</label>
                     </div>
                     <div class="flex items-center">
                         <input type="checkbox" name="delete_purchase" @if (isset($role) && $role->checkPermission('delete_purchase')) checked @endif  id="delete_purchase" class="mr-3">
                         <label for="delete_purchase">წაშლა</label>
                     </div>
                    </div>
                </div>
                            
                {{-- Clients --}}
                <div class="p-2">
                    <span class="flex items-center font-bold text-gray-700 text-xs mt-1"> 
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box w-4 h-4 mr-2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                        კლიენტები 
                    </span>
                    <div class="mt-3 flex justify-between items-center font-normal text-xs">
                     <div class="flex  items-center">
                         <input type="checkbox" name="see_clients" @if (isset($role) && $role->checkPermission('see_clients')) checked @endif  id="see_clients" class="mr-3">
                         <label for="see_clients">ნახვა</label>
                     </div>
                     <div class="flex  items-center">
                         <input type="checkbox" name="add_client" @if (isset($role) && $role->checkPermission('add_client')) checked @endif  id="add_client" class="mr-3">
                         <label for="add_client">დამატება & რედაქტირება</label>
                     </div>
                     <div class="flex items-center">
                         <input type="checkbox" name="delete_client" @if (isset($role) && $role->checkPermission('delete_client')) checked @endif  id="delete_client" class="mr-3">
                         <label for="delete_client">წაშლა</label>
                     </div>
                    </div>
                </div>
                            
                {{-- Company --}}
                <div class="p-2">
                    <span class="flex items-center font-bold text-gray-700 text-xs mt-1"> 
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box w-4 h-4 mr-2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                          კომპანია
                    </span>
                    <div class="mt-3 flex justify-between items-center font-normal text-xs">
                     <div class="flex  items-center">
                         <input type="checkbox" name="see_company" @if (isset($role) && $role->checkPermission('see_company')) checked @endif id="see_company" class="mr-3">
                         <label for="see_company">ნახვა</label>
                     </div>
                     <div class="flex  items-center">
                         <input type="checkbox" name="add_company" @if (isset($role) && $role->checkPermission('add_company')) checked @endif id="add_company" class="mr-3">
                         <label for="add_company">დამატება & რედაქტირება</label>
                     </div>
                     <div class="flex items-center">
                         <input type="checkbox" name="delete_company" @if (isset($role) && $role->checkPermission('delete_company')) checked @endif id="delete_company" class="mr-3">
                         <label for="delete_company">წაშლა</label>
                     </div>
                    </div>
                </div>
    
                {{-- sms --}}
                <div class="p-2">
                    <span class="flex items-center font-bold text-gray-700 text-xs mt-1"> 
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box w-4 h-4 mr-2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                          შეტყობინება
                    </span>
                    <div class="mt-3 flex justify-between items-center font-normal text-xs">
                     <div class="flex  items-center">
                         <input type="checkbox" name="see_sms" id="see_sms" @if (isset($role) && $role->checkPermission('see_sms')) checked @endif  class="mr-3">
                         <label for="see_sms">ნახვა</label>
                     </div>
                     <div class="flex  items-center">
                         <input type="checkbox" name="send_sms" id="send_sms" @if (isset($role) && $role->checkPermission('send_sms')) checked @endif  class="mr-3">
                         <label for="send_sms">დამატება & რედაქტირება</label>
                     </div>
                     <div class="flex items-center">
                         <input type="checkbox" name="delete_sms" id="delete_sms" @if (isset($role) && $role->checkPermission('delete_sms')) checked @endif  class="mr-3">
                         <label for="delete_sms">წაშლა</label>
                     </div>
                    </div>
                </div>
                <div class="p-2">
                    <span class="flex items-center font-bold text-gray-700 text-xs mt-1"> 
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box w-4 h-4 mr-2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                          ფინანსები
                    </span>
                    <div class="mt-3 flex justify-between items-center font-normal text-xs">
                     <div class="flex  items-center">
                         <input type="checkbox" name="export_finances" @if (isset($role) && $role->checkPermission('export_finances')) checked @endif  id="export_finances" class="mr-3">
                         <label for="export_finances">ექსპორტი</label>
                     </div>
                    </div>
                </div>
                <button type="submit" class="mt-3 w-full p-3 bg-indigo-500 text-white text-center font-bolder text-xs font-caps">
                    @if(isset($role)) განახლება @else დამატება @endif
                </button>
            </form>
        </div>
    </div>
    <div class="col-span-12 xxl:col-span-9 gap-6 w-full">
        <div class="col-span-12 grid grid-cols-12 gap-6 mt-5">
            
            @foreach ($roles as $role)
                <div  class="col-span-12 sm:col-span-6 xxl:col-span-3 intro-y relative">
                    @if (!in_array($role->name, ['admin', 'user']))
                        <div class="flex absolute top-0 right-0">
                            <a href="/roles/{{$role->id}}/edit" class="bg-red-500 p-2 text-white flex items-center justify-center font-bolder z-50">
                                <svg width="0.9em" height="0.9em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                  </svg>
                            </a>
                            <a href="{{ route('RemoveRole', $role->id )}}" class="bg-red-500  p-2 text-white flex items-center justify-center font-bolder  z-50">
                                <svg width="0.9em" height="0.9m" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>
                                    <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                                  </svg>
                            </a>
                        </div>
                    @endif
                    <div class="mini-report-chart box p-5 flex items-center justify-between ">
                            <div class="w-2/4 flex-none">
                            <div class="font-bold text-xs">{{$role->name}}</div>
                            </div>
                            <div class="text-gray-600 mt-1 text-xs font-normal">
                                @foreach ($role->permissions as $permission)
                                @lang('permissions.'.$permission->permission->name)
                                @endforeach
                            </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
@section('custom_scripts')
<script type="text/javascript">
	$(document).ready(function() {
            $('.side-menu').removeClass('side-menu--active');
            $('.side-menu[data-menu="user"]').addClass('side-menu--active');
            $('#menuuser ul').addClass('side-menu__sub-open');
            $('#menuuser ul').css('display', 'block');
    });
</script>
@endsection