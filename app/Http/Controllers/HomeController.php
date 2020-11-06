<?php
/**
 *  app/Http/Controllers/HomeController.php
 *
 * User:
 * Date-Time: 01.09.20
 * Time: 13:33
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Http\Controllers;

use App\ClientService;
use App\Client;
use App\PayController;
use App\Service;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ActionHome()
    {
        if (view()->exists('theme.template.home.home_index')) {
            $data = [
                
            ];
            if(auth()->user()->isUser()){
                $user = Auth::user();
                $userclients = ClientService::where('user_id', $user->id);
                $queries = [
                    'date',
                    'status'
                ];
                if(request()->all()){
                    foreach ($queries as $req) {
                        if(request($req)){
                            if($req == "date"){
                                $date = explode(' - ',request($req));
                                
                                $userclients = $userclients->whereDate('session_start_time', '>=', Carbon::parse($date[0]))
                                ->whereDate('session_start_time', '<=', Carbon::parse($date[1]));
                            }else if($req == "status"){
                                $userclients = $userclients->where('status', request($req) == "true" ? true : false);
                            }
                        }
                        $queries[$req] = request($req);
                    }
                }else{
                    $userclients = $userclients->whereDate('session_start_time', Carbon::today());
                }
                $services = Service::all();
                $userclients =  $userclients->paginate(30)->appends($queries);
                return view('theme.template.user.user_profile', compact('services' ,'user', 'userclients', 'queries'));
            }
            
            $date = '';
            if(request('date')){
                $date = request('date');
            }
            $selecteduser = '';
            if(request('users')){
                $selecteduser = request('users');
            }

           
            $allclientservices = ClientService::count();
            $paymethods = PayController::all();
            $alluser = User::permission('user')->get();;
            $services = Service::where('published', 1)->get();
            if ( request('users')) {
            return redirect()->route('userTimeTable', intval(request('users')));
            }else{
            $getusers = array();
            Carbon::setLocale('en');
            foreach (User::permission('user')->where('active', true)->get() as $useri) {
                if($useri->weekdays && in_array(Carbon::now()->isoFormat('dd'), json_decode($useri->weekdays, true))){
                    $getusers[] = $useri->id;
                }
            }
            $users = User::whereIn('id', $getusers)->get();
            }
            $clients = Client::all();
            return view('theme.template.home.home_index', compact('alluser', 'services', 'selecteduser', 'users', 'clients', 'paymethods',  'date'));
        } else {
            abort('404');
        }
    }
}