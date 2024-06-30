<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function register()
    {
        return view('users.register');
    }

    public function login()
    {
        return view('users.login');
    }

    public function numLogin()
    {
        return view('users.numLog');
    }

    public function handNumLog(Request $request)
    {
        $validator=Validator::make(
            ['numero' => $request->numero],
            ['numero' => ['regex:/^(\+261|03[2348])\d{7}$/']]
        );
        if($validator->fails())
        {
            return redirect()->back()->with('error','numero phone ampidirina');
        }
        // $numLog=$request->numero;
        $request->session()->put('numLog', $request->numero);
        return redirect()->to('/devis/listeDevis');
    }

    public function handleRegistration(User $user, CreateUserRequest $request)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect('/')->with('success', 'votre a ete creer');
    }

    public function handleLogin(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        } else {
            return redirect()->back()->with('error','Information de connexion non reconnue');
        }
    }

    public function dashboard(){
        return view('dashboard');
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/login');
    }

    public function logoutClient(){
        session()->forget('numLog');
        return redirect('/');
    }

    public function pageDeleteBase()
    {
        return view('admin.deleteBase');
    }

    public function deleteBase(){
        DB::statement('DELETE FROM users WHERE name != \'admin\'');
        DB::statement('DELETE FROM paiement');
        DB::statement('DELETE FROM detail_devis');
        DB::statement('DELETE FROM devis');
        DB::statement('DELETE FROM finitions');
        DB::statement('DELETE FROM travaux');
        DB::statement('DELETE FROM maisons');
        DB::statement('DELETE FROM unites');
        DB::statement('DELETE FROM csv_maisontravaux');
        DB::statement('DELETE FROM csv_paiement');
        DB::statement('DELETE FROM csv_devis');
        return redirect()->back();
    }
}
