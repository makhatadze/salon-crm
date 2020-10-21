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
use App\Salary;
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
            'client_number' => 'required|string|min:9|max:9',
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
            'client_number' => 'required|string|min:9|max:9',
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
           
            if($client->image){
                Storage::delete('public/clientimg/'.$client->image->name);
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
    public function giveSalary(Request $request, User $user)
    {
        $this->validate($request, [
            'salary_type' => 'required|string',
            'salary' => 'required|integer|min:0',
            'bonus' => '',
            'reason' => '',
            'earn' => ''
        ]);
        if ($user->profile) {
            Salary::create([
                'type' => $request->salary_type,
                'salary' => $request->salary * 100,
                'bonus' => $request->bonus * 100,
                'user_id' => $user->id,
                'made_salary' => $request->earn * 100,
                'description' => $request->reason
            ]);
            return redirect()->back()->with('success', 'ხელფასის გაცემა წარმატებით დაფიქსირდა.');
        }
        return redirect()->back()->with('error', 'დაფიქსირდა შეცდომა');
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
        $user = $clientservice->user;

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
            $userProfile = $user->profile;
            if ($userProfile) {
                SalaryToService::create([
                    'user_id' => $user->id,
                    'service_id' => $id,
                    'service_price' => $clientservice->new_price,
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
            return redirect()->back()->with('success', $message);
        } else {
            return redirect()->back()->with('warning', $message);
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
            $client['workername'] = $client->user->profile->first_name .' '. $client->userlast_name;
            $client['servicename'] = $client->service->{"title_".app()->getLocale()};
            $client['serviceprice'] = $client->getServicePrice();
            $client['clientid'] = $client->clinetserviceable->id;
            $client['clientnumber'] = $client->clinetserviceable->number;
            $client['clientname'] = $client->clinetserviceable->{"full_name_" . app()->getLocale()};
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
        return view('theme.template.company.finance',);
    }
    public function showclients(){
        $date = '';
        if(request('date')){
            $date = request('date');
        }
        $selecteduser = '';
        if(request('users')){
            $selecteduser = request('users');
        }

        $totalclients = Client::count();
        $totalproductcost = Product::sum('price')/100;
        $totalServiceCost = Service::sum('price')/100;
        $allclientservices = ClientService::count();
        $paymethods = PayController::all();
        $alluser = User::permission('user')->get();;
        $services = Service::all();
        if ( request('users')) {
            
        $users = User::permission('user')->where('id', intval(request('users')))
        ->where('active', true)
        ->get();
        }else{
            
        $users = User::permission('user')
        ->where('active', true)
        ->get();
        }
        $clients = Client::all();
        $income = ClientService::where('status', true)
        ->join('services', 'client_services.service_id', '=', 'services.id')
        ->sum('price')/100;
        return view('theme.template.home.home_index', compact('alluser', 'services', 'selecteduser', 'users', 'clients', 'paymethods', 'totalclients', 'income', 'totalServiceCost', 'totalproductcost', 'date'));

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
        
        $personal = User::findOrFail($request->personal);
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
                'author' => Auth::user()->id,
                'department_id' => $personal->userHasJob->department_id ?? null
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
