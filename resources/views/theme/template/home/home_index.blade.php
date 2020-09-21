@extends('theme.layout.layout')

@section('content')
    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
        <div class="col-span-12 mt-8">
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="feather feather-shopping-cart report-box__icon text-theme-10">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                                <div class="ml-auto">
                                    <div class="text-gray-600 font-normal mt-1 text-xs">ყველა შემოსული შეკვეთა</div>
                                </div>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{$allclientservices}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="feather feather-credit-card report-box__icon text-theme-11">
                                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                    <line x1="1" y1="10" x2="23" y2="10"></line>
                                </svg>
                                <div class="ml-auto">
                                    <div class="text-gray-600 font-normal mt-1 text-xs">შემოსავალი სერვისები</div>
                                </div>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{$income}}<sup class="text-sm"> ₾</sup>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="feather feather-monitor report-box__icon text-theme-12">
                                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                    <line x1="8" y1="21" x2="16" y2="21"></line>
                                    <line x1="12" y1="17" x2="12" y2="21"></line>
                                </svg>
                                <div class="ml-auto">
                                    <div class="text-gray-600 font-normal mt-1 text-xs">გამოყენებული სერვისები</div>
                                </div>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{$userdservices}}</div>

                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-user report-box__icon text-theme-9">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <div class="ml-auto">
                                    <div class="text-gray-600 font-normal mt-1 text-xs">დარეგისტრირებული კლიენტები</div>
                                </div>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{$totalclients}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 my-3 container mx-auto">
            @include('inc.message')
        </div>
        <!-- Table -->
        <table class="table table-report -mt-2 col-span-12">
            <thead>
            <tr>
                <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">
                    <input type="date" class="p-2 bg-transparent focus:outline-none focus:border-none"
                           onchange="getdate(`'`+this.value+`'`)" value="<?php echo date('Y-m-d');?>"></th>
                <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">მიმღები</th>
                <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">სერვისი</th>
                <th class="text-center whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">სტატუსი</th>
                <th class="text-center whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">პრივილეგია</th>
            </tr>
            </thead>
            <tbody id="servicebody">

            @if ($todayservices)
                @foreach ($todayservices as $service)
                    <tr class="intro-x">
                        <td>
                            <h6 class="font-bolder text-black">{{$service->clinetserviceable()->first()->{"full_name_".app()->getLocale()} }}</h6>
                            <small class="font-normal">{{$service->clinetserviceable()->first()->number}}</small>
                        </td>
                        <td class="font-normal">
                            <h6 class="font-bolder text-black">{{$service->getWorkerName() }}</h6>
                            <small class="font-normal">
                                დან: {{$service->session_start_time}} <br>
                                მდე: {{$service->getEndTime()}}
                            </small>
                        </td>
                        <td class="font-normal">
                            <h6 class="font-bolder text-black">{{$service->getServicePrice() }} <sup>₾</sup></h6>
                            <small class="font-normal text-sm">{{$service->getServiceName()}}</small>
                        </td>
                        <td class="text-center whitespace-no-wrap font-normal">
                            @if ($service->status)
                                <div class="flex items-center justify-center h-full font-normal text-xs">
                                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16"
                                         class="bi bi-check-circle-fill mr-2" fill="#5dc78c"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                    მიღებულია
                                </div>
                            @elseif(Carbon\Carbon::now() > $service->session_start_time)
                                <div class="flex items-center justify-center h-full font-normal text-xs">
                                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16"
                                         class="bi mr-2 bi-dash-circle-fill" fill="#ff6155"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                                    </svg>
                                    არ მოსულა
                                </div>
                            @elseif(Carbon\Carbon::now() < $service->session_start_time)
                                <div class="flex items-center justify-center h-full font-normal text-xs">
                                    <svg width="1.3em" height="1.3em" viewBox="0 0 16 16"
                                         class="bi mr-2 bi-slash-circle-fill" fill="#ffb52d"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.646-2.646a.5.5 0 0 0-.708-.708l-6 6a.5.5 0 0 0 .708.708l6-6z"/>
                                    </svg>
                                    ველოდებით
                                </div>
                            @endif
                        </td>
                        <td class="text-center whitespace-no-wrap">
                            <div class="flex justify-center items-center">
                                @if (!$service->status)
                                    <a data-toggle="modal" data-target="#add-pay-method"
                                       onclick="addPayMethod({{$service->id}})" id="pay-method-link"
                                       class="bg-gray-300 p-2 rounded-lg mr-2">
                                        <svg width="1.18em" height="1.18em" viewBox="0 0 16 16"
                                             class="bi bi-emoji-laughing" fill="currentColor"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path fill-rule="evenodd"
                                                  d="M12.331 9.5a1 1 0 0 1 0 1A4.998 4.998 0 0 1 8 13a4.998 4.998 0 0 1-4.33-2.5A1 1 0 0 1 4.535 9h6.93a1 1 0 0 1 .866.5z"/>
                                            <path d="M7 6.5c0 .828-.448 0-1 0s-1 .828-1 0S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 0-1 0s-1 .828-1 0S9.448 5 10 5s1 .672 1 1.5z"/>
                                        </svg>
                                    </a>
                                @endif
                                <a href="/clients/edit/{{$service->clinetserviceable()->first()->id}}"
                                   class="bg-gray-300 p-2 rounded-lg mr-2">
                                    <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi  bi-pencil-fill"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                    </svg>
                                </a>
                                <a href="/clients/delete/{{$service->id}}" class="bg-gray-300 p-2 rounded-lg">
                                    <svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-trash2"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M3.18 4l1.528 9.164a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836L12.82 4H3.18zm.541 9.329A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671L14 3H2l1.721 10.329z"/>
                                        <path d="M14 3c0 1.105-2.686 2-6 2s-6-.895-6-2 2.686-2 6-2 6 .895 6 2z"/>
                                        <path fill-rule="evenodd"
                                              d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif

            <div class="modal" id="add-pay-method">
                <div class="modal__content">
                    <div class="intro-y box p-5">
                        {!! Form::open(['class' => 'pay-modal-form', 'url' => route('turnonawqa'), 'method' => 'post']) !!}
                        <div class="modal-container">
                            <label class="font-helvetica"><b>დაამატე გადახდაა</b></label>
                            <div class="sm:grid  mb-5">
                                {{ Form::text('pay_id', '', ['class' => 'input w-full border mt-2 col-span-2','id' => 'pay_id', 'no', 'readOnly' => 'true','hidden' => 'hidden']) }}
                                <div class="relative mt-2 {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <select data-placeholder="Select a company" name="pay_method" id="pay_method"
                                            class="font-helvetica select2 w-full">
                                        <option value="Card">{{__('pay.Card')}}</option>
                                        <option value="Cash">{{__('pay.Cash')}}</option>
                                        <option value="Bank">{{__('pay.Bank')}}</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">
                                დახურვა
                            </button>
                            <button type="submit" class="button w-24 bg-theme-6 text-white">ატვირთვა</button>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>


            </tbody>
        </table>
    </div>
@endsection
@section('custom_scripts')
    <script type="text/javascript">
        function getdate($date) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('GetServiceByDate') }}",
                method: 'post',
                data: {
                    'date': $date,
                },
                success: function (result) {
                    if (result.status == true) {
                        let html = '';
                        let data = result.data;
                        console.log(result.data);
                        data.forEach(function (service) {
                            $dt = new Date('{{Carbon\Carbon::now()}}');
                            $st = new Date(service['session_start_time']);
                            let mark = '';
                            let accept = '';
                            if (service['status'] == true) {
                                mark = `<div class="flex items-center justify-center h-full font-normal text-xs">
                                        <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-check-circle-fill mr-2" fill="#5dc78c" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                                        </svg>მიღებულია
                                        </div>`;

                            } else if ($dt.getTime() < $st.getTime()) {
                                mark = `
                                <div class="flex items-center justify-center h-full font-normal text-xs">
                                        <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi mr-2 bi-slash-circle-fill" fill="#ffb52d" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.646-2.646a.5.5 0 0 0-.708-.708l-6 6a.5.5 0 0 0 .708.708l6-6z"></path>
                                        </svg>
                                        ველოდებით
                                    </div>
                                `;
                                accept = `
                                    <a data-toggle="modal" data-target="#add-pay-method"
                                       onclick="addPayMethod(` + service['id'] + `)" id="pay-method-link"
                                       class="bg-gray-300 p-2 rounded-lg mr-2">
                                        <svg width="1.18em" height="1.18em" viewBox="0 0 16 16"
                                             class="bi bi-emoji-laughing" fill="currentColor"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path fill-rule="evenodd"
                                                  d="M12.331 9.5a1 1 0 0 1 0 1A4.998 4.998 0 0 1 8 13a4.998 4.998 0 0 1-4.33-2.5A1 1 0 0 1 4.535 9h6.93a1 1 0 0 1 .866.5z"/>
                                            <path d="M7 6.5c0 .828-.448 0-1 0s-1 .828-1 0S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 0-1 0s-1 .828-1 0S9.448 5 10 5s1 .672 1 1.5z"/>
                                        </svg>
                                    </a>
								`;
                            } else if ($dt.getTime() > $st.getTime()) {
                                mark = `
                                <div class="flex items-center justify-center h-full font-normal text-xs">
                                        <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi mr-2 bi-dash-circle-fill" fill="#ff6155" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"></path>
                                        </svg>არ მოსულა
                                        </div>`;
                                accept = `
										<a href="/clients/turnon/` + service['id'] + `" class="bg-gray-300 p-2 rounded-lg mr-2">
												<svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-emoji-laughing" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
													<path fill-rule="evenodd" d="M12.331 9.5a1 1 0 0 1 0 1A4.998 4.998 0 0 1 8 13a4.998 4.998 0 0 1-4.33-2.5A1 1 0 0 1 4.535 9h6.93a1 1 0 0 1 .866.5z"/>
													<path d="M7 6.5c0 .828-.448 0-1 0s-1 .828-1 0S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 0-1 0s-1 .828-1 0S9.448 5 10 5s1 .672 1 1.5z"/>
												</svg>
											</a>
								`;
                            }
                            html += `
							  <tr class="intro-x">
									<td>
										<h6 class="font-bolder text-black">` + service['clientname'] + `</h6>
										<small class="font-normal">` + service['clientnumber'] + `</small>
													</td>
									<td class="font-normal">
										<h6 class="font-bolder text-black">` + service['workername'] + `</h6>
										<small class="font-normal">
											დან: ` + service['session_start_time'] + ` <br>
											მდე: ` + service['endtime'] + `
										</small>
									</td>
									<td class="font-normal">
										<h6 class="font-bolder text-black">` + service['serviceprice'] + ` <sup>₾</sup></h6>
										<small class="font-normal text-sm">` + service['servicename'] + `</small>
									</td>
									<td class="text-center whitespace-no-wrap font-normal">
										` + mark + `
									</td>
									<td class="text-center whitespace-no-wrap">
										<div class="flex justify-center items-center">
											` +
                                accept
                                + `
											<a href="/clients/edit/` + service['clientid'] + `" class="bg-gray-300 p-2 rounded-lg mr-2">
												<svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi  bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
												</svg>
											</a>
										<a href="/clients/delete/` + service['id'] + `" class="bg-gray-300 p-2 rounded-lg">
												<svg width="1.18em" height="1.18em" viewBox="0 0 16 16" class="bi bi-trash2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" d="M3.18 4l1.528 9.164a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836L12.82 4H3.18zm.541 9.329A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671L14 3H2l1.721 10.329z"/>
													<path d="M14 3c0 1.105-2.686 2-6 2s-6-.895-6-2 2.686-2 6-2 6 .895 6 2z"/>
													<path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/>
												</svg>
											</a>
										</div>
									</td>
								</tr>
							  `;
                        });
                        $('#servicebody').html('');
                        $('#servicebody').html(html);

                    }
                }
            });

        }

        function addPayMethod(id) {
            $('#pay_id').val(id)
        }

        $(document).ready(function () {
            $('.select2').select2();

        });

    </script>
@endsection