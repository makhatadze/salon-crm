@extends('theme.layout.layout')

@section('content')
    {!! Form::open(['files' => 'true','method'=>'GET']) !!}
    <div class="col-span-12 xxl:col-span-3 -mb-10 pb-10">
        <div class="mt-4 px-4">
            <h6 class="font-bold font-caps text-gray-700 text-xs">ფილტრი</h6>
            <div class="box mt-5 p-2">

                <div class="flex flex-wrap -mx-3  mt-3">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 {{ $errors->has('client_name') ? ' has-error' : '' }}">

                        {{ Form::label('client_name', 'კლიენტის სახელი', ['class' => 'font-helvetica']) }}
                        {{ Form::text('client_name',Request::get('client_name') ? Request::get('client_name') : '', ['class' => 'input w-full border mt-2 col-span-2']) }}
                        @if ($errors->has('client_name'))
                            <span class="help-block">
                                            {{ $errors->first('client_name') }}
                                        </span>
                        @endif
                    </div>
                    <div class="w-full md:w-1/2 px-3 {{ $errors->has('service') ? ' has-error' : '' }}">
                        {{ Form::label('service', 'სერვისი', ['class' => 'font-helvetica']) }}
                        {{ Form::text('service',Request::get('service') ? Request::get('service') : '', ['class' => 'input w-full border mt-2 col-span-2']) }}
                        @if ($errors->has('service'))
                            <span class="help-block">
                                            {{ $errors->first('service') }}
                                        </span>
                        @endif
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3  mt-3">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 {{ $errors->has('date_from') ? ' has-error' : '' }}">
                        {{ Form::label('date_from', 'გადახდის დრო - დან', ['class' => 'font-helvetica']) }}
                        {{ Form::date('date_from', Request::get('date_from') ? Request::get('date_from') : null , ['class' => 'input w-full border mt-2 col-span-2']) }}
                        @if ($errors->has('date_from'))
                            <span class="help-block">
                                            {{ $errors->first('date_from') }}
                                        </span>
                        @endif
                    </div>
                    <div class="w-full md:w-1/2 px-3 {{ $errors->has('date_to') ? ' has-error' : '' }}">
                        {{ Form::label('date_to', 'გადახდის დრო - დან', ['class' => 'font-helvetica']) }}
                        {{ Form::date('date_to', Request::get('date_to') ? Request::get('date_to') : null, ['class' => 'input w-full border mt-2 col-span-2']) }}
                        @if ($errors->has('date_to'))
                            <span class="help-block">
                                            {{ $errors->first('date_to') }}
                                        </span>
                        @endif
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3  mt-3 {{ $errors->has('price_from') ? ' has-error' : '' }}">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        {{ Form::label('price_from', 'ფასი - დან', ['class' => 'font-helvetica']) }}
                        {{ Form::text('price_from',Request::get('price_from') ? Request::get('price_from') : '', ['class' => 'input w-full border mt-2 col-span-2']) }}
                        @if ($errors->has('price_from'))
                            <span class="help-block">
                                            {{ $errors->first('price_from') }}
                                        </span>
                        @endif
                    </div>
                    <div class="w-full md:w-1/2 px-3 {{ $errors->has('price_to') ? ' has-error' : '' }}">
                        {{ Form::label('price_to', 'ფასი - მდე', ['class' => 'font-helvetica']) }}
                        {{ Form::text('price_to',Request::get('price_to') ? Request::get('price_to') : '', ['class' => 'input w-full border mt-2 col-span-2']) }}
                        @if ($errors->has('price_to'))
                            <span class="help-block">
                                            {{ $errors->first('price_to') }}
                                        </span>
                        @endif
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3  mt-3">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 {{ $errors->has('pay_method') ? ' has-error' : '' }}">
                        {{ Form::label('pay_method', 'გადახდის მეთოდი', ['class' => 'font-helvetica']) }}
                        {{ Form::select('pay_method', ['all' => __('pay.All'), 'Bank' => __('pay.Bank'),'Cash' => __('pay.Cash'),'Card' => __('pay.Card')],
                         Request::get('pay_method') ? Request::get('pay_method') : '',
                        ['class' => 'input w-full border mt-2 col-span-12 font-helvetica']) }}
                        @if ($errors->has('pay_method'))
                            <span class="help-block">
                                            {{ $errors->first('pay_method') }}
                                        </span>
                        @endif
                    </div>
                    <div class="w-full md:w-1/2 px-3 {{ $errors->has('pay_status') ? ' has-error' : '' }}">
                        {{ Form::label('pay_status', 'სტატუსი მეთოდი', ['class' => 'font-helvetica']) }}
                        {{ Form::select('pay_status', ['0' => __('pay.All'), '1' => 'მიღებული','2' => 'ველოდებით','3' => 'არ მოსულა'],
                         Request::get('pay_status') ? Request::get('pay_status') : '',
                        ['class' => 'input w-full border mt-2 col-span-12 font-helvetica']) }}
                        @if ($errors->has('pay_status'))
                            <span class="help-block">
                                            {{ $errors->first('pay_status') }}
                                        </span>
                        @endif
                    </div>
                </div>
                <button type="submit"
                        class="mt-2 block appearance-none font-bold font-caps bg-indigo-500 text-xs text-white w-full bg-gray-200 border border-gray-200  py-3 px-4 pr-8 rounded leading-tight">
                    ძებნა
                </button>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="{{ route('FinanceExport') }}"
               class="button text-white font-bold font-caps text-xs bg-theme-1 shadow-md mr-2">ექსელში ექსპორტი</a>
        </div>
    </div>
    <table class="table table-report -mt-2 col-span-8">
        <thead>
        {{--        <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">--}}
        {{--            <input type="date" class="p-2 bg-transparent focus:outline-none focus:border-none"--}}
        {{--                   onchange="getdate(`'`+this.value+`'`)" value="<?php echo date('Y-m-d');?>"></th>--}}
        <tr>
            <th class="whitespace-no-wrap font-bold font-caps text-gray-700 text-xs">კლიენტის სახელი</th>
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

        function getRequest() {
            let ClientName = $("input[name='client_name']").val();
            let Service = $("input[name='service']").val();
            let DateFrom = $("input[name='date_from']").val();
            let DateTo = $("input[name='date_from']").val();
            let PriceFrom = $("input[name='price_from']").val()
            let PriceTo = $("input[name='price_to']").val()
            let PayMethod = $("input[name='pay_method']").val()
            let PayStatus = $("input[name='pay_status']").val()
            let getUrl = window.location;
            let baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
            let url = `${baseUrl}/clients/services?client_name=${ClientName}&&service=${Service}&&date_from=${DateFrom}&&$date_to=${DateTo}&&price_from=${PriceFrom}`
            window.location.href = url;
        }
    </script>
@endsection
