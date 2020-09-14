<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Service;
use App\User;
use Carbon\Carbon;
use App\ClientService;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientservices = ClientService::whereNull('deleted_at')->paginate(25);
        return view('theme.template.client.clients', compact('clientservices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::whereNull('deleted_at')->get();
        $workers = User::role('user')->whereNull('deleted_at')->get();
        return view('theme.template.client.add_client', compact('workers', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
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
        if($request->input('userpicker') && $request->input('datepicker') && $request->input('timepicker') && $request->input('servicepicker')){
            foreach($request->input('userpicker') as $key => $item){
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clientservice = ClientService::findOrFail($id);
        $clientservice->delete();
        return redirect('/clients');
    }
    public function turnon($id){
        $clientservice = ClientService::findOrFail($id);
        $clientservice->status = true;
        $clientservice->save();
        return redirect('/clients');
    }
}
