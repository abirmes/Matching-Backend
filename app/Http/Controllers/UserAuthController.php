<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
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
                'name' => 'required|string',
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
        
        $user = new User();
        $user->name = $registerUserData['name'] ;
        $user->email = $registerUserData['email'] ;
        $user->date_naissance = $registerUserData['date_naissance'] ;
        $user->password = $registerUserData['password'] ;

        return $user;

        
        $user = User::create([
            'name' => $registerUserData['name'],
            'email' => $registerUserData['email'],
            'date_naissance' => $registerUserData['date_naissance'],
            'password' => Hash::make($registerUserData['password']),
        ]);
        return redirect()->route('activities');
    }

    public function login(Request $request)
    {
        $loginUserData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|min:8'
        ]);
        $user = User::where('email', $loginUserData['email'])->first();
        if (!$user || !Hash::check($loginUserData['password'], $user->password)) {
            return redirect()->route('login')->with('password incorrect');
        }
        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
        return redirect()->route('welcome');
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return redirect()->route('login');
    }
}
