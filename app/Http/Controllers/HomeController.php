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

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Auth;
use App\ClientService;
use App\Client;
use App\Service;
use DB;
use Carbon\Carbon;

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
            if(Auth::user()->isUser()){
                $user = Auth::user();
                $userclients = ClientService::where('user_id', $user->id)->whereNull('deleted_at')->get();
                return view('theme.template.user.user_profile', compact('user', 'userclients'));
            }
            
            $queries = [
                'date',
                'pricefrom',
                'pricetill',
                'client_name',
                'worker_name',
            ];
            if(request()->all()){
                $todayservices = ClientService::whereNull('client_services.deleted_at')
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
                $todayservices = $todayservices->paginate(40);
            }else{
                $todayservices = ClientService::whereDate('session_start_time', Carbon::today())->whereNull('deleted_at')->paginate(40);
            }
            $totalclients = Client::whereNull('deleted_at')->count();
            $userdservices = ClientService::where('status', true)->count();
            $allclientservices = ClientService::count();
            $income = ClientService::where('status', true)
            ->join('services', 'client_services.service_id', '=', 'services.id')
            ->sum('price')/100;
            return view('theme.template.home.home_index', compact('totalclients', 'userdservices', 'income', 'allclientservices', 'todayservices', 'queries'));
        } else {
            abort('404');
        }
    }
}
