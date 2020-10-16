<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientService;
use App\Department;
use App\Exports\ClientExport;
use App\Exports\ClientServices;
use App\Exports\FinanceExport;
use App\MemberGroup;
use App\PayController;
use App\Product;
use App\SalaryToService;
use App\Service;
use App\User;
use App\UserJob;
use Carbon\Carbon;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Period\Period;

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
        if (request($queries[0])) {
            $clients = $clients->where('full_name_' . app()->getLocale(), 'LIKE', '%' . request($queries[0]) . '%')
                ->orWhere('number', 'LIKE', '%' . request($queries[0]) . '%');
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
        $departments = Department::all();
        $groups = MemberGroup::all();
        $workers = User::role('user')->where('active', true)->whereNull('deleted_at')->get();
        return view('theme.template.client.add_client', compact('workers', 'groups', 'departments', 'services'));
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
            'client_number' => 'required|string',
            'sex' => '',
            'group' => '',
            'group_name' => '',
            'client_name_ru' => '',
            'client_name_en' => '',
            'client_address' => '',
            'client_mail' => '',
            'client_image' => '',
        ]);
        $client = new Client;
        if ($request->input('group_name') != "") {
            $group = new MemberGroup;
            $group->name = $request->input('group_name');
            $group->save();
            $client->group_id = $group->id;
        } else {
            $client->group_id = $request->input('group');
        }
        
        $client->full_name_ge = $request->input('client_name_ge');
        $client->full_name_ru = $request->input('client_name_ru');
        $client->full_name_en = $request->input('client_name_en');
        $client->personal_number = $request->input('personal_number');
        $client->birthday_date = $request->input('birthday_date');
        $client->number = $request->input('client_number');
        $client->address = $request->input('client_address');
        $client->email = $request->input('client_mail');
        if($request->input('sex') == ""){
            $client->sex = "other";
        }else{
            $client->sex = $request->input('sex');
        }
        
        $client->save();

        if($request->hasFile('client_image')){
            $imagename = date('Ymhs').$request->file('client_image')->getClientOriginalName();
            $destination = base_path() . '/storage/app/public/clientimg';
            $request->file('client_image')->move($destination, $imagename);
            $client->image()->create([
                'name' => $imagename
            ]);
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
        $departments = Department::all();
        $groups = MemberGroup::all();
        $client = Client::findOrFail($id);
        $services = Service::where('published', true)->get();
        $workers = User::role('user')->where('active', true)->whereNull('deleted_at')->get();
        return view('theme.template.client.edit_client', compact('departments', 'workers', 'services', 'client', 'groups'));
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
            'client_number' => 'required|string',
            'sex' => 'required|string',
            'group' => '',
            'group_name' => '',
            'client_name_ru' => '',
            'client_name_en' => '',
            'client_address' => '',
            'client_mail' => '',
            'client_image' => ''
        ]);
        $client = Client::findOrFail($id);
        if ($request->input('group_name') != "") {
            $group = new MemberGroup;
            $group->name = $request->input('group_name');
            $group->save();
            $client->group_id = $group->id;
        } else {
            $client->group_id = $request->input('group');
        }
        if($request->hasFile('client_image')){
            $imagename = date('Ymhs').$request->file('client_image')->getClientOriginalName();
            $destination = base_path() . '/storage/app/public/clientimg';
            $request->file('client_image')->move($destination, $imagename);
            Storage::delete('public/clientimg/'.$client->image->name);
            if($client->image){
                $firstimg = $client->image;
                $firstimg->name = $imagename;
                $firstimg->save();
            }else{
                $client->image()->create([
                    'name' => $imagename
                ]);
            }
        }
        $client->full_name_ge = $request->input('client_name_ge');
        $client->full_name_ru = $request->input('client_name_ru');
        $client->full_name_en = $request->input('client_name_en');
        $client->personal_number = $request->input('personal_number');
        $client->birthday_date = $request->input('birthday_date');
        $client->number = $request->input('client_number');
        $client->address = $request->input('client_address');
        $client->email = $request->input('client_mail');
        $client->sex = $request->input('sex');
        $client->save();
     
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
            'pay_id' => 'required|integer',
            'pay_method' => 'required',
            'paid' => '',
        ]);
        // Check Pay Method
        if($request->pay_method != "consignation"){
            $paymethod = PayController::find(intval($request->pay_method));
            if(!$paymethod){
                return redirect('/')->with('error', ' გადახდის მეთოდი არ მოიძებნა');
            }    
        }
        
        $id = $request->pay_id;
        $clientservice = ClientService::where('status', false)->findOrFail($id);
        $user = $clientservice->getUser();

        $message = '';
        $service = Service::find($clientservice->service_id);
        $success = false;
        if ($service) {
            $success = true;
            $inventories = $service->inventories()->get();

                $message = '';
                foreach ($inventories as $prods) {
                    $prod = Product::find($prods->product_id);
                    if ($prod) {
                        if ($prod->stock == 0 || $prod->stock < $prods->quantity) {
                            return redirect('/')->with('error', $prod->id . ' | ' . $prod->{"title_" . app()->getLocale()} . ' მარაგი ცარიელია ან არასაკმარისი');
                        } elseif ($prod->published == false) {
                            return redirect('/')->with('error', $prod->id . ' | ' . $prod->{"title_" . app()->getLocale()} . ' სტატუსი გათიშულია');
                        } else if ($prod->stock - $prods->quantity == 0 || $prod->stock - $prods->quantity <= $prods->quantity) {
                            $message .= $prod->id . ' | ' . $prod->{"title_" . app()->getLocale()} . ' მარაგი შესავსევბია <br>';
                        } else {
                            $message .= 'სტატუსი წარმატებით განახლდა';
                        }
                        $prod->stock = $prod->stock - $prods->quantity;
                        $prod->save();
                    }
                }
            
        } else {
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
        if ($request->pay_method == "consignation") {
            $clientservice->session_endtime = Carbon::now('Asia/Tbilisi');
            $clientservice->pay_method = "consignation";
            $clientservice->paid = intval($request->paid * 100);
        }else{
            $clientservice->pay_method_id = $paymethod->id;
            $clientservice->session_endtime = Carbon::now('Asia/Tbilisi');
            $clientservice->pay_method = $paymethod->{"name_".app()->getLocale()};
        }
        $clientservice->save();
        if ($success) {
            return redirect('/')->with('success', $message);
        } else {
            return redirect('/')->with('warning', $message);
        }
    }
    public function getUserServices(Request $request)
    {
        $this->validate($request, [
            'userid' => 'required|integer'
        ]);
        $user = User::findOrFail($request->userid);
        $html = '';
        foreach ($user->services($request->userid) as $item) {
            $html .= '<option value="'.$item->id.'">'.$item->{'title_'.app()->getLocale()} .'</option>';
        }
        return response()->json(array('status' => true, 'html' => $html));
    }
    public function checktime(Request $request)
    { //დაასრულებელი ამის დედაც
        $this->validate($request, [
            'date' => 'required|string',
            'start' => 'required|string',
            'end' => 'required|string',
            'user_id' => 'required',
            'serv_id' => 'required',
        ]);
        $services = ClientService::where('user_id', '=', intval($request->user_id))
            ->whereDay('session_start_time', '=', Carbon::parse($request->date))
            ->get();
        $chkStartTime = Carbon::parse($request->date.' '.$request->start);
        $chkEndTime = Carbon::parse($request->date.' '.$request->end);
        $message = '';
        foreach ($services as $key => $serv) {
            $startTime = Carbon::parse($serv->session_start_time);
            $endTime = Carbon::parse($serv->session_start_time)->addMinutes($serv->duration);
            if($chkStartTime > $startTime && $chkEndTime < $endTime)
            {
                $message = "არჩეული დრო უკვე დაჯავშნილი სერვისის შუალედშია";
                break;
            }
            elseif($chkStartTime > $startTime && $chkStartTime < $endTime || $chkEndTime > $startTime && $chkEndTime < $endTime)
            {
                $message = "დაწყების ან დასრულების დრო დაჯავშნილი სერვისის შუალედშია";
                break;
            }
            elseif($chkStartTime == $endTime || $chkStartTime == $startTime || $chkEndTime == $startTime  || $chkEndTime == $endTime )
            {
                $message = "დაწყების ან დასრულების დრო დაჯავშნილი სერვისის დაწყების ან დასრულების დროს ემთხვევა";
                break;
            }
            elseif($chkStartTime==$startTime || $chkEndTime==$endTime)
            {
                $message = "დაწყების ან დასრულების უკვე დაჯავშნილი სერვისის საზღვარზეა";
                break;
            }
            elseif($startTime > $chkStartTime && $endTime < $chkEndTime)
            {
                $message = "დაწყების და დასრულების დრო არის უკვე დაკავებულია";
                break;
            }
        }
        return response()->json(array('status' => true, 'message' => $message));
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
            ->join('services', 'services.id', '=', 'client_services.service_id')
            ->join('clients', 'clients.id', '=', 'client_services.clinetserviceable_id');
        if ($request) {
            if ($request->client_name) {
                $clientName = 'clients.full_name_' . App()->getLocale();
                $services = $services->where($clientName, 'like', '%' . $request->client_name . '%');
            }
//            $services = $services->where('CONCAT(profiles.first_name, ", ", profiles.last_name)', 'LIKE',  'ჯოხაძე');
            if ($request->service) {
                $serviceTitle = 'services.title_' . App()->getLocale();
                $services = $services->where($serviceTitle, 'LIKE', '%' . $request->service . '%');
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
    public function showclients(){
         
        $queries = [
            'date',
            'pricefrom',
            'pricetill',
            'client_name',
            'worker_name',
        ];
        if(request()->all()){
            $todayservices = ClientService::query()
            ->join('services', 'client_services.service_id', '=', 'services.id')
            ->join('clients', 'client_services.clinetserviceable_id', '=', 'clients.id')
            ->join('profiles', 'client_services.user_id', '=', 'profiles.profileable_id');
            foreach ($queries as $req) {
                if(request($req)){
                    if($req == "date"){
                        $date = explode(' - ',request($req));
                        $todayservices = $todayservices->whereDate('session_start_time', '>=', Carbon::parse($date[0]))
                        ->whereDate('session_start_time', '<=', Carbon::parse($date[1]));
                    }elseif($req == "pricefrom"){
                        $todayservices = $todayservices->where('price', '>=', request($req)*100);
                    }elseif($req == "pricetill"){
                        $todayservices = $todayservices->where('price', '<=', request($req)*100);
                    }elseif($req == "client_name"){
                        $todayservices = $todayservices->where('full_name_'.app()->getLocale(), 'like', '%'.request($req).'%');
                    }
                    $queries[$req] = request($req);
                }
            }
            $todayservices = $todayservices->select('client_services.id', 'client_services.clinetserviceable_id', 'client_services.user_id', 'client_services.service_id', 'client_services.status', 'client_services.status', 'services.title_'.app()->getLocale(), 'client_services.session_start_time', 'clients.number', 'clients.full_name_'.app()->getLocale(), 'services.price', 'profiles.first_name', 'profiles.last_name');
            
            $todayservices = $todayservices->paginate(40)->appends($queries);

        }else{
            
            $todayservices = ClientService::query()
            ->join('services', 'client_services.service_id', '=', 'services.id')
            ->join('clients', 'client_services.clinetserviceable_id', '=', 'clients.id')
            ->join('profiles', 'client_services.user_id', '=', 'profiles.profileable_id');
            $todayservices = $todayservices->select('client_services.id', 'client_services.clinetserviceable_id', 'client_services.user_id', 'client_services.status', 'client_services.service_id', 'client_services.status', 'services.title_'.app()->getLocale(), 'client_services.session_start_time', 'clients.number', 'clients.full_name_'.app()->getLocale(), 'services.price', 'profiles.first_name', 'profiles.last_name');
            $todayservices = $todayservices->whereDate('session_start_time', Carbon::today());
            $todayservices = $todayservices->paginate(40)->appends($queries);
        }
        $totalclients = Client::count();
        $totalproductcost = Product::sum('price')/100;
        $totalServiceCost = Service::sum('price')/100;
        $allclientservices = ClientService::count();
        $paymethods = PayController::all();
        $services = Service::all();
        $income = ClientService::where('status', true)
        ->join('services', 'client_services.service_id', '=', 'services.id')
        ->sum('price')/100;
        return view('theme.template.home.home_index', compact('services', 'paymethods', 'totalclients', 'income', 'totalServiceCost', 'todayservices', 'totalproductcost', 'queries'));
    }
    public function serviceselect(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer'
        ]);
        $service = Service::findorFail($request->id);
        $duration = $service->duration_count;
        $price = $service->price/100;
        $users = UserJob::where('service_id', $request->id)->select('users.id', 'profiles.first_name', 'profiles.last_name')
                ->join('users', 'user_jobs.user_id', '=', 'users.id')
                ->join('profiles', 'profiles.profileable_id', '=', 'user_jobs.user_id')
                ->get();
        $html = '';
        foreach($users as $user){
            $html .= '<option value="'.$user->id.'">'.$user->first_name.' '.$user->last_name.'</option>';
        }
        return response()->json(array('status' => true, 'html' => $html, 'duration' => $duration, 'price' => $price));
    }
    public function addservice(Request $request)
    {
        $this->validate($request, [
            'service' => 'required',
            'personal' => 'required|integer',
            'date' => 'required',
            'time' => 'required',
            'duration' => 'required',
            'price' => 'required',
        ]);
        if($request->client){
            $client = Client::findOrFail(intval($request->client));
        }elseif($request->input('full_name_ge') && $request->input('client_number')){
            $client = Client::create([
                'full_name_ge' => $request->input('full_name_ge'),
                'number' => $request->input('client_number'),
            ]);
        }else{
            return redirect()->back()->with('error', 'აირჩიეთ ან დაარეგისტრირეთ ახალი კლიენტი');
        }

        $services = array();
        foreach($request->input('service') as $key => $service){
            $time = explode(":", $request->input('time')[$key]);
            $services[] = [
                'service_id' => intval($request->service[$key]),
                'user_id' => $request->personal,
                'session_start_time' => Carbon::parse($request->input('date')[$key])->settime($time[0], $time[1]),
                'duration' => intval($request->duration[$key]),
                'new_price' => intval($request->price[$key]*100),
                'paid' => 0,
                'author' => Auth::user()->id
            ]; 
        }
        $client->clientservices()->createMany($services);
        return redirect()->back();
    }
    /**
     * Convert to Excel
     */
    public function export()
    {
        return Excel::download(new ClientExport, 'client.xlsx');
    }

    public function financeExport()
    {
        return Excel::download(new FinanceExport(), 'finance.xlsx');
    }

    public function clientserviceexport(Client $client)
    {
        return Excel::download(new ClientServices($client->id), $client->{"full_name_" . app()->getLocale()} . '.xlsx');
    }
    public function addconsignation(Request $request, ClientService $ClientService)
    {
        $this->validate($request, [
            'paid' => 'required|numeric|min:0'
        ]);
        if($ClientService->pay_method == "consignation" && $ClientService->new_price > $ClientService->paid){
            $ClientService->paid = intval($request->paid*100);
            $ClientService->save();
        }
        return redirect()->back();
    }

}
