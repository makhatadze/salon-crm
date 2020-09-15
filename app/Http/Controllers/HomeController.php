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
                $userclients = ClientService::where('user_id', $user->id)->get();
                return view('theme.template.user.user_profile', compact('user', 'userclients'));
            }
            return view('theme.template.home.home_index', $data);
        } else {
            abort('404');
        }
    }
}
