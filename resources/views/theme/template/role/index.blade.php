@extends('theme.layout.layout')

@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 lg:col-span-4 xl:col-span-3">
        <div class="box mt-5 p-5">
        <form action="{{ route('AddRole') }}" method="POST">
            @csrf
                <div class="w-full">
                    <input
                     class="appearance-none font-bold text-xs block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                       type="text"
                       name="rolename"
                       required
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
                         <input type="checkbox" name="see_products" id="see_products" class="mr-3">
                         <label for="see_product">ნახვა</label>
                     </div>
                     <div class="flex  items-center">
                         <input type="checkbox" name="add_product" id="add_product" class="mr-3">
                         <label for="add_product">დამატება & რედაქტირება</label>
                     </div>
                     <div class="flex items-center">
                         <input type="checkbox" name="delete_product" id="delete_product" class="mr-3">
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
                         <input type="checkbox" name="see_purchases" id="see_purchases" class="mr-3">
                         <label for="see_purchases">ნახვა</label>
                     </div>
                     <div class="flex  items-center">
                         <input type="checkbox" name="add_purchase" id="add_purchase" class="mr-3">
                         <label for="add_purchase">დამატება & რედაქტირება</label>
                     </div>
                     <div class="flex items-center">
                         <input type="checkbox" name="delete_purchase" id="delete_purchase" class="mr-3">
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
                         <input type="checkbox" name="see_clients" id="see_clients" class="mr-3">
                         <label for="see_clients">ნახვა</label>
                     </div>
                     <div class="flex  items-center">
                         <input type="checkbox" name="add_client" id="add_client" class="mr-3">
                         <label for="add_client">დამატება & რედაქტირება</label>
                     </div>
                     <div class="flex items-center">
                         <input type="checkbox" name="delete_client" id="delete_client" class="mr-3">
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
                         <input type="checkbox" name="see_company" id="see_company" class="mr-3">
                         <label for="see_company">ნახვა</label>
                     </div>
                     <div class="flex  items-center">
                         <input type="checkbox" name="add_company" id="add_company" class="mr-3">
                         <label for="add_company">დამატება & რედაქტირება</label>
                     </div>
                     <div class="flex items-center">
                         <input type="checkbox" name="delete_company" id="delete_company" class="mr-3">
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
                         <input type="checkbox" name="see_sms" id="see_sms" class="mr-3">
                         <label for="see_sms">ნახვა</label>
                     </div>
                     <div class="flex  items-center">
                         <input type="checkbox" name="send_sms" id="send_sms" class="mr-3">
                         <label for="send_sms">დამატება & რედაქტირება</label>
                     </div>
                     <div class="flex items-center">
                         <input type="checkbox" name="delete_sms" id="delete_sms" class="mr-3">
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
                         <input type="checkbox" name="export_finances" id="export_finances" class="mr-3">
                         <label for="export_finances">ექსპორტი</label>
                     </div>
                    </div>
                </div>
                <button type="submit" class="mt-3 w-full p-3 bg-indigo-500 text-white text-center font-bolder text-xs font-caps">
                    დამატება
                </button>
            </form>
        </div>
    </div>
    <div class="col-span-12 xxl:col-span-9 gap-6 w-full">
        <div class="col-span-12 grid grid-cols-12 gap-6 mt-5">
            
            @foreach ($roles as $role)
                <div class="col-span-12 sm:col-span-6 xxl:col-span-3 intro-y relative">
                    @if (!in_array($role->name, ['admin', 'user']))
                    <a href="{{ route('RemoveRole', $role->id )}}" class="bg-red-500 absolute h-5 text-white flex items-center justify-center w-5 font-bolder top-0 right-0 z-50">
                        x
                    </a>
                    @endif
                    <div class="mini-report-chart box p-5 flex items-center justify-between zoom-in">
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