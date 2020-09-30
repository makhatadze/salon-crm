<?php
/**
 *  app/Http/Controllers/UserController.php
 *
 * User:
 * Date-Time: 31.08.20
 * Time: 13:55
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Http\Controllers;

use App\Company;
use App\Office;
use App\Profile;
use App\User;
use App\Department;
use App\ClientService;
use App\Exports\OneUserExport;
use App\Exports\ServiceExport;
use App\UserHasJob;
use Carbon\Carbon;

use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ActionUser(Request $request)
    {
        if (view()->exists('theme.template.user.user_index')) {
            if (request()->ajax()) {
                if ($request->searchValue) {
                    return User::query()
                        ->where('name', 'LIKE', "%{$request->searchValue}%")
                        ->with(['Image', 'Profile'])
                        ->paginate($request->pagination);
                } else {
                    return User::query()
                        ->with(['Image', 'Profile'])
                        ->paginate($request->pagination);
                }
            }
            $users = User::query()
                ->with(['Image', 'Profile'])
                ->paginate(25);
            return view('theme.template.user.user_index', compact('users'));
        } else {
            abort('404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ActionUserAdd(Request $request)
    {
        if (view()->exists('theme.template.user.user_add')) {
            if ($request->isMethod('post') && auth()->user()->isAdministrator()) {
                $data = $request->all();
                $this->validate($request, [
                    'first_name' => 'required|string',
                    'last_name' => 'required|string',
                    'birthday' => 'required|string',
                    'email' => 'required|email|unique:users',
                    'pid' => 'required',
                    'position' => 'required|string',
                    'phone' => 'required',
                    'salary' => 'min:0|integer',
                    'percent' => 'required|numeric|between:0,99.99',
                    'password' => 'required|min:8',
                    'password_confirmation' => 'required_with:password|same:password|min:8',
                    'files' => 'image|mimes:jpeg,bmp,png,gif,svg',
                ]);
                $user = new User([
                    'name' => $data['first_name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);

                $user->save();

                $user->roles()->attach($data['position']);

                if ($request->hasFile('files')) {
                    $imagename = date('Ymhs') . $request->file('files')->getClientOriginalName();
                    $destination = base_path() . '/storage/app/public/profile/' . $user->id;
                    $request->file('files')->move($destination, $imagename);
                    $user->image()->create([
                        'name' => $imagename
                    ]);
                }

                $profile = new Profile([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'birthday' => $data['birthday'],
                    'position' => $data['position'],
                    'phone' => $data['phone'],
                    'pid' => $data['pid'],
                    'salary' => $data['salary'],
                    'salary_type' => $data['salary_type'],
                    'percent' => $data['percent'],
                ]);

                $user->profile()->save($profile);

                if ($request->company) {
                    foreach ($request->company as $key => $item) {
                        $model = new UserHasJob();
                        $model->user_id = $user->id;
                        $model->company_id = $item;
                        if (isset($request->office)) {
                            if ($request->office && $request->office[$key]) {
                                $model->office_id = $request->office[$key];
                            }
                        }
                        if (isset($request->department)) {
                            if ($request->department && $request->department[$key]) {
                                $model->department_id = $request->department[$key];
                            }
                        }


                        $model->save();

                    }
                }


                return redirect('user')->with('success', 'User added.');


            }

            $data = [

            ];

            $companies = Company::whereNull('deleted_at')->get();

            return view('theme.template.user.user_add', [
                'companies' => $companies
            ]);
        } else {
            abort('404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ActionUserData(Request $request)
    {
        if (request()->ajax()) {
            $request->all();
            if ($request->company) {
                $company = Company::wherenull('deleted_at')->findOrFail($request->company);
                return $company->offices()->wherenull('deleted_at')->get();
            }
            if ($request->office) {
                $office = Office::wherenull('deleted_at')->findOrFail($request->office);
                return $office->departments()->wherenull('deleted_at')->get();
            }
        } else {
            abort('404');
        }
    }
    /**
     * User Profile 
     */
    public function profile(){
        $user = auth::user();
        return view('theme.template.user.user_profile', compact('user'));
    }
    public function changepassword(){
        $user = auth::user();
        return view('theme.template.user.user_change_password', compact('user'));
    }
    public function storenewpassword(Request $request){
        $this->validate($request,[
            'old_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if(Hash::check($request->input('old_password'), Auth::user()->password)){
            $user = auth::user();
            $user->password = Hash::make($request->input('password'));
            $user->save();
        }
        return redirect('/');
    }
    public function accountsetting(){
        $user = auth::user();
        $departments = Department::whereNull('deleted_at')->get();
        return view('theme.template.user.user_account_settings', compact('user', 'departments'));
    }
    /**
     * Turn Profile On or Off
     */
    public function turnprofile($status){
        $user = auth::user();
        $user->active = $status;
        $user->save();
        return redirect('/');
    }
    public function profilefilter(Request $request){
        $this->validate($request,[
            'filter' => 'required|string', 
            'userid' => 'required|integer'
        ]);
        if($request->filter == "all"){
            $clients = ClientService::where('user_id', $request->userid)->get();
        }elseif($request->filter == "done"){
            $clients = ClientService::where([['user_id', $request->userid], ['status', true]])->get();
        }elseif($request->filter == "waiting"){
            $clients = ClientService::where([['user_id', $request->userid], ['session_start_time', '>', Carbon::now()], ['status', false]])->get();
        }elseif($request->filter == "notcome"){
            $clients = ClientService::where([['user_id', $request->userid], ['session_start_time', '<', Carbon::now()], ['status', false]])->get();
        }else{
            return response()->json(array('status' => false));
        }
        foreach($clients as $client){
            $client['endtime'] = $client->getEndTime();
            $client['servicename'] = $client->getServiceName();
            $client['serviceprice'] = $client->getServicePrice();
            $client['clientnumber'] = $client->clinetserviceable()->first()->number;
            $client['clientname'] = $client->clinetserviceable()->first()->{"full_name_".app()->getLocale()};
        }
        return response()->json(array('status' => true, 'data' => $clients));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function showprofile($id){
        $user = User::findOrFail($id);
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
    public function showprofilesettings($id){
        $user = User::findOrFail($id);
        $departments = Department::whereNull('deleted_at')->get();
        return view('theme.template.user.user_account_settings', compact('user', 'departments'));
    }
    public function updateuserprofile(Request $request, $id){
        $this->validate($request,[
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'user_percent' => 'required|numeric|between:0,99.99',
            'user_salary' => 'required|integer|min:0',
            'department_id' => ''
        ]);
        $user = User::findOrFail($id);
        $profile = $user->profile()->first();
        
        if(trim($request->input('phone')," ") != trim($profile->phone," ")){
            $this->validate($request,[
                'phone' => 'required|string|unique:profiles',
            ]);
            $profile->phone = $request->input('phone');
        }

        if($request->input('email') != $user->email){
            $this->validate($request,[
                'email' => 'required|email|max:255|unique:users',
            ]);
            $user->email = $request->input('email');
        }
        $profile->first_name = $request->input('first_name');
        $profile->last_name = $request->input('last_name');
        $profile->salary = $request->input('user_salary');
        $profile->percent = $request->input('user_percent');

        $userhasjobs = $user->userHasJob;
        $userhasjobs->department_id = $request->input('department_id');
        $userhasjobs->save();
        $profile->save();
        $user->save();
        return redirect()->back();
    }
    //User Exports
    public function userexport(){
        return Excel::download(new UserExport, 'users.xlsx');
    }
    public function oneuserexport(User $user){
        return Excel::download(new OneUserExport($user->id), $user->profile->first_name.'_'.$user->profile->last_name.'.xlsx');
    }
}
