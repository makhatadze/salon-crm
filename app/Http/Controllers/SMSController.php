<?php

namespace App\Http\Controllers;

use App\SMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $smses = SMS::orderBy('id', 'desc')->get();
        
        return view('theme.template.marketing.sms', compact('smses'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|integer',
            'text' => 'required|string',
        ]);  
        $sender = env("SMS_OFFICE_API_NAME", "");
        $text = $request->text;
        $api =  env("SMS_OFFICE_API_KEY", "");
        $phone = '995'.$request->phone;
        $data = 'key=' . $api . '&destination=' . $phone . '&sender=' . $sender. '&content=' . $text; 
        $url= "http://smsoffice.ge/api/v2/send?".$data;
        if (Http::get('http://smsoffice.ge/api/getBalance?key='.$api) > 0) {
            $response = Http::get("http://smsoffice.ge/api/v2/send?".$data);
            SMS::create([
                'user_id' => Auth::user()->id,
                'number' => $phone,
                'text' => $text
            ]);
            dd($response);
            return $this->checkMessage($response);
        }
        return redirect()->back()->with('error', 'SMS ბალანსი არ არის საკმარისი');
    }

    private function checkMessage($response)
    {
        if ($response == 0) {
            return redirect()->back()->with('success', 'მესიჯი მიღებულია smsoffice -ს მიერ სამომავლოდ ნომერთან გადასაგზავნად. ეს ჯერ არ ნიშნავს, რომ მესიჯი მივიდა მობილურ ტელეფონში. მესიჯის მისვლას შეიტყობთ მიღების უწყისში');
        }elseif($response == 20){
            return redirect()->back()->with('error', 'ბალანსი არასაკმარისია');
        }elseif($response == 40){
            return redirect()->back()->with('error', 'გასაგზავნი ტექსტი 160 სიმბოლოზე მეტია');
        }elseif($response == 60){
            return redirect()->back()->with('error', 'ბრძანებას აკლია გასაგზავნი ტექსტი');
        }elseif($response == 70){
            return redirect()->back()->with('error', 'ბრძანებას აკლია ნომრები');
        }elseif($response == 80){
            return redirect()->back()->with('error', 'key -ს შესაბამისი მომხმარებელი ვერ მოიძებნა');
        }elseif($response == 110){
            return redirect()->back()->with('error', 'sender პარამეტრის მნიშვნელობა გაუგებარია');
        }elseif($response == 120){
            return redirect()->back()->with('error', 'გააქტიურეთ api -ის გამოყენების უფლება პროფილის გვერდზე');
        }elseif($response == 150){
            return redirect()->back()->with('error', 'sender არ იძებნება სისტემაში. შეამოწმეთ მართლწერა');
        }elseif($response == 500){
            return redirect()->back()->with('error', 'ბრძანებას აკლია key პარამეტრი');
        }elseif($response == 600){
            return redirect()->back()->with('error', 'ბრძანებას აკლია destination პარამეტრი');
        }elseif($response == 700){
            return redirect()->back()->with('error', 'ბრძანებას აკლია sender პარამეტრი');
        }elseif($response == 800){
            return redirect()->back()->with('error', 'ბრძანებას აკლია content პარამეტრი');
        }elseif($response == -100){
            return redirect()->back()->with('error', 'დროებითი შეფერხება');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SMS $sMS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SMS  $sMS
     * @return \Illuminate\Http\Response
     */
    public function destroy(SMS $sMS)
    {
        //
    }
}
