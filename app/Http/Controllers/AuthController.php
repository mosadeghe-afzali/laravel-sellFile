<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Utils;

class AuthController extends Controller
{
    public function showLoginPage(){
        return view('userViews.login');
    }

    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;
        if( Auth::attempt(['username' => $username, 'password' => $password]))
        {
            $user = User::query()->select( 'username', 'deleted_at')->where('username', $request->username)->first();
            $request->session()->put('username', $username);
            return redirect('/home');
        }
        else{
            return Redirect::back()->withErrors(['msg' => 'username or password is wrong']);
        }
    }

    public static function userLevel(){
        if(Session::has('username')) {
            $username = session()->get('username');
            $userId = User::query()->where('username', $username)->value('id');
            $role = DB::table('users')
                ->join('role_user', 'users.id', '=', 'role_user.user_id')
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->select('roles.role')->where('users.id', '=', $userId)
                ->value('roles.role');
            return $role;
        }

    }

    public function logout()
    {
        session()->forget('username');
        return redirect::back();
    }
}
