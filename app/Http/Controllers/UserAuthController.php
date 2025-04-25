<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Adresse;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function registerPage()
    {
        return view('register');
    }

    public function loginPage()
    {
        return view('login');
    }

    public function register(Request $request)
    {
        try{
            $registerUserData = $request->validate([
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'date_naissance' => 'required|date_format:Y-m-d',
                'password' => 'required|min:8',
                'boulevard' => 'required|string',
                'city' => 'required|string',
                'country' => 'required|string',
    
            ]);
        } catch(Exception $e){
            return $e->getMessage();
        }

        $adresse = new Adresse();
        $adresse->boulevard = $registerUserData['boulevard'];
        $adresse->city = $registerUserData['city'];
        $adresse->country = $registerUserData['country'];
        $adresse->save();

        $role = Role::where('name' , 'utilisateur')->first();

        
        $user = new User();
        $user->firstname = $registerUserData['firstname'] ;
        $user->lastname = $registerUserData['lastname'] ;
        $user->email = $registerUserData['email'] ;
        $user->date_naissance = $registerUserData['date_naissance'] ;
        $user->password = $registerUserData['password'] ;
        $user->adresse()->associate($adresse);
        $user->role()->associate($role);
        $user->status = StatusEnum::Active;
        $user->merite = 100;
        $user->save();
        return redirect()->route('login');
    }

    // public function login(Request $request)
    // {
        // $loginUserData = $request->validate([
        //     'email' => 'required|string|email',
        //     'password' => 'required|min:8'
        // ]);
        // $user = User::where('email', $loginUserData['email'])->first();
        // if (!$user || !Hash::check($loginUserData['password'], $user->password)) {
        //     return redirect()->route('login')->with('password incorrect');
        // }
        
        // $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
        
        // return redirect()->route('home');
    // }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->back();
    }
    // public function logout()
    // {
    //     try{
    //         auth()->user()->tokens()->delete();
    //     return redirect()->route('login');
    //     }catch(Exception $e){
    //         return redirect()->route('login');
    //     }
    // }
}
