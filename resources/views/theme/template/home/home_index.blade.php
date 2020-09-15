@extends('theme.layout.layout')

@section('content')
<div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
	<div class="col-span-12 mt-8">
		<div class="grid grid-cols-12 gap-6 mt-5">
			<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
				<div class="report-box zoom-in">
					<div class="box p-5">
						<div class="flex">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart report-box__icon text-theme-10"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg> 
							<div class="ml-auto">
								<div class="text-gray-600 font-normal mt-1 text-xs">ყველა შემოსული შეკვეთა</div></div>
						</div>
						<div class="text-3xl font-bold leading-8 mt-6">{{$allclientservices}}</div>
					</div>
				</div>
			</div>
			<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
				<div class="report-box zoom-in">
					<div class="box p-5">
						<div class="flex">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card report-box__icon text-theme-11"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg> 
							<div class="ml-auto">
								<div class="text-gray-600 font-normal mt-1 text-xs">შემოსავალი სერვისები</div></div>
						</div>
						<div class="text-3xl font-bold leading-8 mt-6">{{$income}}<sup class="text-sm"> ₾</sup></div>
					</div>
				</div>
			</div>
			<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
				<div class="report-box zoom-in">
					<div class="box p-5">
						<div class="flex">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor report-box__icon text-theme-12"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg> 
							<div class="ml-auto">
								<div class="text-gray-600 font-normal mt-1 text-xs">გამოყენებული სერვისები</div></div>
						</div>
						<div class="text-3xl font-bold leading-8 mt-6">{{$userdservices}}</div>
						
					</div>
				</div>
			</div>
			<div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
				<div class="report-box zoom-in">
					<div class="box p-5">
						<div class="flex">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user report-box__icon text-theme-9"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> 
							<div class="ml-auto">
								<div class="text-gray-600 font-normal mt-1 text-xs">დარეგისტრირებული კლიენტები</div></div>
						</div>
					<div class="text-3xl font-bold leading-8 mt-6">{{$totalclients}}</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection