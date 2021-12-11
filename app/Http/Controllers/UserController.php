<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
      @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(AuthController::userLevel() == 'admin'){
            $users = User::query()->get();
            return view('userViews\showUsers', ['users' => $users]);
        }
        else{
        return Redirect::back()->withErrors(['msg' => 'you can not access this section']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
      @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('userViews.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
      @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $pass = Hash::make($request->password);
        $user->password = $pass;
        $user->username = $request->username;
        $user->save();
        $userId = $user->id;

        $role = new Role();
        $role->role = 'common_user';
        $role->save();
        $roleId = $role->id;

        $userRole = User::query()->find($userId);
        $userRole->roles()->attach($roleId);
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::query()->select('username' , 'deleted_at', 'id')->where('id', $id)->get();
        $file = File::query()->where('user_id' , $id)->count('id');
        return view('userViews.userProfile', ['user' => $user, 'file' => $file ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roleId = DB::table('role_user')->select('role_id')->where('user_id' , $id)->value('role_id');

        $role = Role::query()->find($roleId);
        $role->role = 'admin';
        $role->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::query()->find($id);
        $user->delete();
        session()->forget(['username' => $user->username]);
    }

    public function userPanel()
    {
        if (!session()->has('username'))
        {
            return redirect(route('home'));
        }

        $username = session()->get('username');

        $filesize = File::query()->join('users', 'files.user_id', '=', 'users.id')
            ->where('users.username', $username)->sum('size');
        $userCredit = File::query()->join('users', 'files.user_id', '=', 'users.id')
            ->where('users.username', $username)->sum('price');
        $downloadNumbers = File::query()->join('users', 'files.user_id', '=', 'users.id')
            ->where('users.username', $username)->select('download_numbers')->value('download_numbers');
        $data = ['fileSize' => $filesize, 'userCredit' => $userCredit, 'downloadNumbers' => $downloadNumbers];

        return view('userViews.userPanel', ['data' => $data]);
    }

}
