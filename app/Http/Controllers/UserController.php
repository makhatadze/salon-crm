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

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                    return  User::query()
                        ->where('name', 'LIKE', "%{$request->searchValue}%")
                        ->with(['Image','Profile'])
                        ->paginate($request->pagination);
                } else {
                    return  User::query()
                        ->with(['Image','Profile'])
                        ->paginate($request->pagination);
                }
            }
            $users = User::query()
                ->with(['Image','Profile'])
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
                    'percent' => 'integer',
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
                    'percent' => $data['pid'],
                ]);

                $user->profile()->save($profile);

                return redirect('user')->with('success', 'User added.');


            }
            $data = [

            ];


            return view('theme.template.user.user_add', $data);
        } else {
            abort('404');
        }
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
}
