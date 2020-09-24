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
use App\Product;
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
                }
                $userclients =  $userclients->paginate(30)->appends($queries);
                return view('theme.template.user.user_profile', compact('user', 'userclients', 'queries'));
            }
            
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
                $todayservices = $todayservices->select('client_services.id','client_services.status', 'client_services.status', 'services.title_'.app()->getLocale(), 'client_services.session_start_time', 'clients.number', 'clients.full_name_'.app()->getLocale(), 'services.price', 'profiles.first_name', 'profiles.last_name');
                $todayservices = $todayservices->paginate(40)->appends($queries);

            }else{
                
                $todayservices = ClientService::query()
                ->join('services', 'client_services.service_id', '=', 'services.id')
                ->join('clients', 'client_services.clinetserviceable_id', '=', 'clients.id')
                ->join('profiles', 'client_services.user_id', '=', 'profiles.profileable_id');
                $todayservices = $todayservices->select('client_services.id','client_services.status', 'client_services.status', 'services.title_'.app()->getLocale(), 'client_services.session_start_time', 'clients.number', 'clients.full_name_'.app()->getLocale(), 'services.price', 'profiles.first_name', 'profiles.last_name');
                $todayservices = $todayservices->paginate(40)->appends($queries);
            }
            $totalclients = Client::count();
            $totalproductcost = Product::sum('price')/100;
            $totalServiceCost = Service::sum('price')/100;
            $allclientservices = ClientService::count();
            $income = ClientService::where('status', true)
            ->join('services', 'client_services.service_id', '=', 'services.id')
            ->sum('price')/100;
            return view('theme.template.home.home_index', compact('totalclients', 'income', 'totalServiceCost', 'todayservices', 'totalproductcost', 'queries'));
        } else {
            abort('404');
        }
    }
}
