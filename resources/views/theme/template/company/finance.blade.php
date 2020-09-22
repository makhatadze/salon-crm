@extends('theme.layout.layout')

@section('content')
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="{{ route('FinanceExport') }}"
               class="button text-white font-bold font-caps text-xs bg-theme-1 shadow-md mr-2">ექსელში ექსპორტი</a>
        </div>
    </div>
    <table class="table table-report -mt-2 col-span-12">
        <thead>
        <tr>
            <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">
                <input type="date" class="p-2 bg-transparent focus:outline-none focus:border-none"
                       onchange="getdate(`'`+this.value+`'`)" value="<?php echo date('Y-m-d');?>"></th>
            <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">სერვისი</th>
            <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">თანხა</th>
            <th class="text-center whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">გადახდის მეთოდი</th>
            <th class="text-center whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">გადახდის დრო</th>
            <th class="text-center whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">სტატუსი</th>
        </tr>
        </thead>
        <tbody id="servicebody">
        @if ($services && count($services) != 0)
            @foreach ($services as $service)
                <tr class="intro-x">
                    <td>
                        <h6 class="font-normal text-black">{{$service->clinetserviceable()->first()->{"full_name_".app()->getLocale()} }}</h6>
                    </td>
                    <td class="font-normal">
                        <small class="font-normal text-sm">{{$service->getServiceName()}}</small>
                    </td>
                    <td class="font-normal">
                        <small class="font-normal text-sm">{{$service->getServicePrice() }} <sup>₾</sup></small>
                    </td>
                    <td class="text-center whitespace-no-wrap">
                        <small class="font-normal text-sm">{{$service->pay_method ? __('pay.'.$service->pay_method) : ''}}</small>
                    </td>
                    <td class="text-center whitespace-no-wrap">
                        <div class="flex justify-center items-center">
                            <small class="font-normal text-sm">{{$service->session_start_time}}</small>
                        </div>
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

                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    @if(!$services || count($services) == 0)
        <div class="no-result-msg">
            <h1>There is not result.</h1>
        </div>
    @endif
@endsection
@section('custom_scripts')
    <script type="text/javascript">
        function getdate(date) {
            let getUrl = window.location;
            let baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
            let url = `${baseUrl}/clients/services?date=${date}`
            window.location.href = url;
        }
    </script>
@endsection
