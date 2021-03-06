<?php

namespace App\Http\Controllers;

use App\Cashier;
use App\Client;
use App\ClientService;
use App\Department;
use App\Exports\ClientExport;
use App\Exports\ClientServices;
use App\Exports\FinanceExport;
use App\Exports\SalaryExport;
use App\MemberGroup;
use App\PayController;
use App\Product;
use App\Salary;
use App\SalaryToService;
use App\Sale;
use App\Service;
use App\User;
use App\UserJob;
use App\Voucher;
use Carbon\Carbon;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\ImageManagerStatic as Imagev;
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
        $clients = new Client();
        $queries = [
            'name',
            'phone',
            'consignation',
            'group'
        ];
        foreach ($queries as $req) {
            if(request($req)){
                if($req == "name"){
                    $clients = $clients->where('full_name_ge', 'like', '%'.request($req).'%');
                }elseif($req == "phone"){
                    $clients = $clients->where('number', 'like', '%'.request($req).'%');
                }elseif(isset(request()->consignation)){
                    $services = ClientService::select('clinetserviceable_id')
                    ->where('pay_method', '=', 'consignation')
                    ->whereColumn('new_price', '>', 'paid')
                    ->get();
                    $sales = Sale::select('client_id')
                    ->where('pay_method', '=', 'consignation')
                    ->whereColumn('total', '>', 'paid')
                    ->get();
                    $clients = $clients->whereIn('id', $sales)->orWhereIn('id', $services);
                }elseif($req == "group"){
                    $clients = $clients->where('group_id', request($req));
                }
            }
            $queries[$req] = request($req);
        }
        $groups = MemberGroup::select('id', 'name')->get();
        $clients = $clients->paginate(50)->appends($queries);
        return view('theme.template.client.clients', compact('clients', 'queries', 'groups'));
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
            $img = Imagev::make($request->file('client_image'));
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $imagename = date('Ymhs').$request->file('client_image')->getClientOriginalName();
            Storage::disk('public')->put("clientimg/".$imagename, (string) $img->encode());
            
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
            $img = Imagev::make($request->file('client_image'));
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $imagename = date('Ymhs').$request->file('client_image')->getClientOriginalName();
            Storage::disk('public')->put("clientimg/".$imagename, (string) $img->encode());

            if($client->image){
                Storage::delete('public/storage/clientimg/'.$client->image->name);
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
            'amout' => '',
            'bonus' => '',
            'reason' => '',
            'earn' => '',
            'cashier' => 'required|integer'
        ]);
        $cashier = Cashier::findOrFail(intval($request->cashier));
        $amout = 0;
        if ($request->salary_type == "avansi") {
            $cashier->amout = $cashier->amout - ($request->amout ? $request->amout * 100 : 0);
            $amout = ($request->amout ? $request->amout * 100 : 0);
        }elseif($request->salary_type == "salary"){
            $cashier->amout = $cashier->amout - ($request->amout ? $request->amout * 100 : 0) + ($request->bonus ? $request->bonus * 100 : 0);
            $amout = ($request->amout ? $request->amout * 100 : 0) + ($request->bonus ? $request->bonus * 100 : 0);
        }elseif($request->salary_type == "earn"){
            $cashier->amout = $cashier->amout - ($request->earn ? $request->earn * 100 : 0);
            $amout = ($request->earn ? $request->earn * 100 : 0);
        }
        if ($user->profile) {
            Salary::create([
                'type' => $request->salary_type,
                'salary' => $request->amout ? $request->amout * 100 : 0,
                'bonus' => $request->bonus ? $request->bonus * 100 : 0,
                'made_salary' => $request->earn ? $request->earn * 100 : 0,
                'avansi_complate' => 0,
                'user_id' => $user->id,
                'cashier_id' => $cashier->id,
                'description' => $request->reason
            ]);
            if ( $cashier->save()) {
                $cashier->paid()->create([
                    'description' => __('paymethod.givesalary') .' ID: '.$user->id,
                    'amout' => $amout
                ]);
            }
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
            'changeprice' => '',
            'paid' => '',
            'voucher' => ''
        ]);

        // Check Pay Method
        if($request->pay_method != "consignation"){
            $paymethod = PayController::find(intval($request->pay_method));
            if(!$paymethod){
                return redirect('/')->with('error', ' გადახდის მეთოდი არ მოიძებნა');
            }    
        }
        // Check Client Service
        $id = $request->pay_id;
        $clientservice = ClientService::where('status', false)->findOrFail($id);
        $clientservice->new_price = intval(($request->input('changeprice') ?? 0) * 100);
        // Service Products
        $json = array();
        if ($request->input('productnames') && $request->input('productquntity') && $request->input('newproductprice')) {
            foreach ($request->input('productnames') as $key => $value) {
                $json[$key]['product_id'] = $request->input('productnames')[$key];
                $json[$key]['productquntity'] = $request->input('productquntity')[$key];
                $json[$key]['newproductprice'] = $request->input('newproductprice')[$key]*100;
            }
        }
        // Worker
        $user = $clientservice->user; 
        // Check And Validate Product
        foreach($json as $prod){
            $product = Product::Find(intval($prod['product_id']));
            if ($product) {
                if ($product->stock < $prod['productquntity']) {
                    return redirect()->back()->with('warning', 'Product is Not Enough');
                }
            }else{
                return redirect()->back()->with('warning', 'There is No product like this');
            }
        }
        // Service Products
            $clientservice->products()->createMany($json);
        // New Price
            $clientservice->new_price = $clientservice->new_price + intval($request->newserviceprice*100);
        // Minusproduct
            foreach($json as $prod){
                $product = Product::Find(intval($prod['product_id']));
                $product->stock = $product->stock - $prod['productquntity'];
                $product->save();
            }
        // Voucher
        $topay = $clientservice->new_price;
        $willpay = ($request->paid != '') ? intval($request->paid * 100) : 0;
        if ($clientservice->new_price < $willpay) {
            $willpay = $topay;
        }
        $vouchermoney = 0;
        if ($request->voucher) {
            $voucher = Voucher::where([['code', $request->voucher], ['money', '>', 0], ['status', '=', 1]])->first();
            if ($voucher) {
                
                if($voucher->money <= ($topay - $willpay)){
                    
                    $voucher->VoucherHistory()->create([
                        'description' => __('voucher.paidservice'),
                        'paid' => $voucher->money,
                    ]);
                    $willpay = $voucher->money;
                    $vouchermoney = $voucher->money;
                    $voucher->money = 0;
                    $voucher->save();
                }else if($voucher->money > ($topay - $willpay)){
                    
                    $voucher->money = $voucher->money - ($topay - $willpay);
                    $vouchermoney = $topay - $willpay;
                    $voucher->VoucherHistory()->create([
                        'description' => __('voucher.paidservice'),
                        'paid' => $topay - $willpay,
                    ]);
                    $willpay = $topay;
                    

                    $voucher->save();
                }
            }
           
        }
        // Save Client Service as Paid
        if ($request->pay_method == "consignation") {
            $clientservice->session_endtime = Carbon::now('Asia/Tbilisi');
            $clientservice->pay_method = "consignation"; 
            $clientservice->paid = $willpay;

            $cashier = Cashier::where('id', 1)->first();
            $cashier->amout += $clientservice->paid - $vouchermoney;
            if ($cashier->save()) {
                $cashier->paid()->create([
                    'description' => __('paymethod.consignation_on_service') .' ID: '.$clientservice->id,
                    'amout' => $clientservice->paid
                ]);
            }
        }else{
            $clientservice->pay_method_id = $paymethod->id;
            $clientservice->session_endtime = Carbon::now('Asia/Tbilisi');
            $clientservice->paid = $clientservice->new_price;
            $clientservice->pay_method = $paymethod->name_ge;

            $cashier = $paymethod->cashier;
            $cashier->amout += $clientservice->paid - $vouchermoney;
            if ($cashier->save()) {
                $cashier->paid()->create([
                    'description' => __('paymethod.pay_on_service') .' ID: '.$clientservice->id,
                    'amout' => $clientservice->paid
                ]);
            };
        }
        $clientservice->salaryToService()->create([
            'user_id' => $user->id,
            'salary_status' =>  $clientservice->service->salary_status,
            'service_id' => $clientservice->id,
            'service_price' => $clientservice->new_price,
            'percent' => $clientservice->user->profile->percent,
            'sale_percent' => $clientservice->user->profile->percent_from_sales
        ]);
        $clientservice->status = true;
       
        $clientservice->save();
        return redirect()->back();
    }
    public function getUserServices(Request $request)
    {
        $this->validate($request, [
            'userid' => 'required|integer'
        ]);
        $user = User::findOrFail($request->userid);
        $html = '';
        foreach ($user->services($request->userid) as $item) {
            $html .= '<option value="'.$item->id.'">'.$item->title_ge .'</option>';
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
            $client['servicename'] = $client->service->title_ge;
            $client['serviceprice'] = $client->getServicePrice();
            $client['clientid'] = $client->clinetserviceable->id;
            $client['clientnumber'] = $client->clinetserviceable->number;
            $client['clientname'] = $client->clinetserviceable->full_name_ge;
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
        return view('theme.template.company.finance');
    }
    public function showclients(){
        $user = Auth::user();
        if(request('date')){
            $date = Carbon::parse(request('date'));
        }else{
            $date = Carbon::today();
        } 
        $clients = Client::all();
        
        $products = Product::select('id', 'title_ge')->where([['fromwarehouse', 1], ['writedown', 1]])->get();
        $paymethods = PayController::all();
        return view('theme.template.user.user_timetable', compact('user', 'clients', 'date', 'paymethods', 'products'));
    }
    public function serviceselect(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer'
        ]);
        $service = Service::findOrFail(intval($request->id));
        $duration = $service->duration_count;
        $price = $service->price/100;

        return response()->json(array('status' => true, 'duration' => $duration, 'price' => $price));
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
                'unchanged_service_price' => intval($request->price[$key]*100),
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
        return Excel::download(new FinanceExport(), 'sale.xlsx');
    }

    public function exportsalary()
    {
        return Excel::download(new SalaryExport(), 'salary.xlsx');
    }
    public function clientserviceexport(Client $client)
    {
        return Excel::download(new ClientServices($client->id), $client->full_name_ge.'.xlsx');
    }
    public function addconsignation(Request $request, ClientService $ClientService)
    {
        $this->validate($request, [
            'paid' => 'required|numeric|min:0'
        ]);
        if($ClientService->pay_method == "consignation" && $ClientService->new_price > $ClientService->paid){
            $toupdate = $ClientService->SalaryToService;
            $toupdate->updated_at = Carbon::now();
            $toupdate->save();
            $cashier = Cashier::where('id', 1)->first();
            $cashier->amout = $cashier->amout - $ClientService->paid;
            $ClientService->paid = intval($request->paid*100);
            $cashier->amout += $ClientService->paid;
            $cashier->save();
            $cashier->paid()->create([
                'description' => __('paymethod.change_service_consignation') .' ID: '.$ClientService->id,
                'amout' => $ClientService->paid
            ]);

            $ClientService->save();
        }
        return redirect()->back();
    }
    public function removeclientservice(ClientService $clientservice)
    {
        if ($clientservice->status == 0) {
            $clientservice->delete();
        }
        return redirect()->back();
    }

}
