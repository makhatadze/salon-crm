<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientService;
use App\Exports\ClientExport;
use App\Exports\FinanceExport;
use App\Product;
use App\SalaryToService;
use App\Service;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::whereNull('deleted_at');
        $queries = [
            'search'
        ];
        if(request($queries[0])){
            $clients = $clients->where('full_name_'.app()->getLocale(), 'LIKE', '%'.request($queries[0]).'%')
            ->orWhere('number', 'LIKE', '%'.request($queries[0]).'%');
            $queries[$queries[0]] = request($queries[0]);
        }
        $clients = $clients->paginate(50)->appends($queries);
        return view('theme.template.client.clients', compact('clients', 'queries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::where('published', true)->get();
        $workers = User::role('user')->where('active', true)->whereNull('deleted_at')->get();
        return view('theme.template.client.add_client', compact('workers', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'client_name_ge' => 'required|string',
            'client_name_ru' => '',
            'client_name_en' => '',
            'client_address' => '',
            'client_number' => 'required|string',
            'userpicker' => '',
            'datepicker' => '',
            'timepicker' => '',
            'servicepicker' => '',
        ]);
        $client = new Client;
        $client->full_name_ge = $request->input('client_name_ge');
        $client->full_name_ru = $request->input('client_name_ru');
        $client->full_name_en = $request->input('client_name_en');
        $client->number = $request->input('client_number');
        $client->address = $request->input('client_address');
        $client->save();
        $clientservices = array();
        if ($request->input('userpicker') && $request->input('datepicker') && $request->input('timepicker') && $request->input('servicepicker')) {
            foreach ($request->input('userpicker') as $key => $item) {
                $time = Carbon::parse($request->datepicker[$key])->setTimeFromTimeString($request->timepicker[$key]);
                $clientservices[] = [
                    'user_id' => $request->userpicker[$key],
                    'service_id' => $request->servicepicker[$key],
                    'session_start_time' => $time,
                ];
            }
            $client->clientservices()->createMany($clientservices);
        }
        return redirect('/clients');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $services = Service::where('published', true)->get();
        $workers = User::role('user')->where('active', true)->whereNull('deleted_at')->get();
        return view('theme.template.client.edit_client', compact('workers', 'services', 'client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'client_name_ge' => 'required|string',
            'client_name_ru' => '',
            'client_name_en' => '',
            'client_address' => '',
            'client_number' => 'required|string',
            'userpicker' => '',
            'datepicker' => '',
            'timepicker' => '',
            'servicepicker' => '',
        ]);
        $client = Client::findOrFail($id);
        $client->full_name_ge = $request->input('client_name_ge');
        $client->full_name_ru = $request->input('client_name_ru');
        $client->full_name_en = $request->input('client_name_en');
        $client->number = $request->input('client_number');
        $client->address = $request->input('client_address');
        $client->save();
        $clientservices = array();

        if ($request->input('userpicker') && $request->input('datepicker') && $request->input('timepicker') && $request->input('servicepicker')) {
            foreach ($request->input('userpicker') as $key => $item) {

                $time = Carbon::parse($request->datepicker[$key])->setTimeFromTimeString($request->timepicker[$key]);
                $clientservices[] = [
                    'user_id' => $request->userpicker[$key],
                    'service_id' => $request->servicepicker[$key],
                    'session_start_time' => $time
                ];
            }
            $client->clientservices()->createMany($clientservices);
        }
        return redirect('/clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clientservice = ClientService::findOrFail($id);
        $clientservice->deleted_at = Carbon::now('Asia/Tbilisi');
        $clientservice->save();
        return redirect('/clients');
    }

    /**
     * Destroy Client with Client Services
     */
    public function destroyclient($id)
    {
        $client = Client::findOrFail($id);
        $client->deleted_at = Carbon::now('Asia/Tbilisi');
        foreach ($client->clientservices()->get() as $service) {
            $service->deleted_at = Carbon::now('Asia/Tbilisi');
            $service->save();
        }
        $client->save();
        return redirect('/clients');
    }

    /**
     * Client Service is Active
     */
    public function turnon(Request $request)
    {
        $data = $request->all();
        $this->validate($request, [
            'pay_id' => 'required',
            'pay_method' => 'required|string',
        ]);
        $id = $request->pay_id;
        $clientservice = ClientService::where('status', false)->findOrFail($id);
        $user = $clientservice->getUser();

        $message = '';
        $service = Service::find($clientservice->service_id);
        
        if ($service) {
            
            $inventories = $service->inventories()->get();
            if(count($inventories) > 0){
                $message = '';
            foreach ($inventories as $prods) {
                $prod = Product::find($prods->product_id);
                if ($prod) {
                    $success = false;
                    if ($prod->stock == 0 || $prod->stock < $prods->quantity) {
                        return redirect('/')->with('error', $prod->id . ' | ' . $prod->{"title_" . app()->getLocale()} . ' მარაგი ცარიელია ან არასაკმარისი');
                    }elseif($prod->published == false){
                        return redirect('/')->with('error', $prod->id . ' | ' . $prod->{"title_" . app()->getLocale()} . ' სტატუსი გათიშულია');
                    } else if ($prod->stock - $prods->quantity == 0 || $prod->stock - $prods->quantity <= $prods->quantity) {
                        $message .= $prod->id . ' | ' . $prod->{"title_" . app()->getLocale()} . ' მარაგი შესავსევბია <br>';
                    } else {
                        $success = true;
                        $message .= 'სტატუსი წარმატებით განახლდა';
                    }
                    $prod->stock = $prod->stock - $prods->quantity;
                    $prod->save();
                }
            }
            }else{
                return redirect('/')->with('error', 'სერვის არ გააჩნია ინვენტარი');
            }
        }else{
            return back()->with('error', 'დაფიქსირდა შეცდომა');
        }
        if ($user) {
            $userProfile = $user->profile()->first();
            if ($userProfile) {
                SalaryToService::create([
                    'user_id' => $user->id,
                    'service_id' => $id,
                    'service_price' => $clientservice->getServicePrice() * 100,
                    'percent' => $userProfile->percent
                ]);
            }
        }
        $clientservice->status = true;
        $clientservice->pay_method = $request->pay_method;
        $clientservice->save();
        if ($success) {
            return redirect('/')->with('success', $message);
        } else {
            return redirect('/')->with('warning', $message);
        }
    }

    /**
     * get Client Services By date
     */
    public function getbydate(Request $request)
    {
        $this->validate($request, [
            'date' => 'required'
        ]);
        $date = $request->date;
        $services = ClientService::whereDate('session_start_time', Carbon::parse(Str::substr($date, 1, strlen($date) - 2)))->whereNull('deleted_at')->get();
        foreach ($services as $client) {
            $client['endtime'] = $client->getEndTime();
            $client['workername'] = $client->getWorkerName();
            $client['servicename'] = $client->getServiceName();
            $client['serviceprice'] = $client->getServicePrice();
            $client['clientid'] = $client->clinetserviceable()->first()->id;
            $client['clientnumber'] = $client->clinetserviceable()->first()->number;
            $client['clientname'] = $client->clinetserviceable()->first()->{"full_name_" . app()->getLocale()};
        }
        return response()->json(array('status' => true, 'data' => $services));
    }

    /**
     * Remove Service From Client By Ajax
     */
    public function removeservice(Request $request)
    {
        $this->validate($request, [
            'serviceid' => 'required|integer'
        ]);
        $id = (int)$request->input('serviceid');
        $service = ClientService::findOrFail($id);
        $service->deleted_at = Carbon::now('Asia/Tbilisi');
        if ($service->save()) {
            return response()->json(array('status' => true));
        }
        return response()->json(array('status' => false));
    }

    public function services(Request $request)
    {
        $this->validate($request, [
            'client_name' => 'nullable|string|max:30',
            'service' => 'nullable|string',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date',
            'price_from' => 'nullable|numeric|',
            'price_to' => 'nullable|numeric|gt:price_from',
            'pay_method' => "nullable|string",
            'pay_status' => "nullable|string",
        ]);
        $services = ClientService::query()
            ->join('profiles', 'profiles.profileable_id', '=', 'client_services.user_id')
            ->join('services', 'services.id', '=', 'client_services.service_id');
        if ($request) {
            if ($request->client_name) {
                $name = explode(' ', $request->client_name);
                $services = $services->where('profiles.first_name', 'like', '%' . $name[0] . '%');
                if (isset($name[1])) {
                    $services = $services->where('profiles.last_name', 'like', '%' . $name[1] . '%');
                }
            }
//            $services = $services->where('CONCAT(profiles.first_name, ", ", profiles.last_name)', 'LIKE',  'ჯოხაძე');
            if ($request->service) {
                $serviceTitle = 'services.title_' . App()->getLocale();
                $services = $services->where('services.title_en', 'LIKE', '%' . $request->service . '%');
            }
            if ($request->date_from) {
                $services = $services->whereDate('client_services.session_start_time', '>=', Carbon::parse($request->date_from));
            }
            if ($request->date_to) {
                $services = $services->whereDate('client_services.session_start_time', '<=', Carbon::parse($request->date_to));
            }
            if ($request->price_from) {
                $services = $services->where('services.price', '>=', $request->price_from * 100);
            }
            if ($request->price_to) {
                $services = $services->where('services.price', '<=', $request->price_to * 100);
            }
            if ($request->pay_method && $request->pay_method != 'all') {
                $services = $services->where('client_services.pay_method', '=', $request->pay_method);
            }
            if ($request->pay_status != 0) {
                if ($request->pay_status == 1) {
                    $services = $services->where('client_services.status', '=', true);
                }
                if ($request->pay_status == 2) {
                    $services = $services->where('client_services.status', '=', false);
                    $services = $services->whereDate('client_services.session_start_time', '>', Carbon::now());
                }
                if ($request->pay_status == 3) {
                    $services = $services->where('client_services.status', '=', false);
                    $services = $services->whereDate('client_services.session_start_time', '<', Carbon::now());
                }
            }
        }

        $services = $services->paginate(20);

//        $services = ClientService::whereNull('deleted_at')->paginate(20);

//        $services = ClientService::whereNull('deleted_at')->paginate(20);
        return view('theme.template.company.finance', compact('services'));
    }

    /**
     * Convert to Excel
     */
    public
    function export()
    {
        return Excel::download(new ClientExport, 'client.xlsx');
    }

    public
    function financeExport()
    {
        return Excel::download(new FinanceExport(), 'finance.xlsx');
    }

}
