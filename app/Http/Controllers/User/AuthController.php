<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->user_id=strtolower($request->user_id);
        $request->password=strtolower($request->password);

        if (Auth::guard('web')->attempt($request->only('user_id', 'password'))) {
          
            
            return redirect()
            ->route('user.fees')
            ->with('status', 'You are Logged in as Admin!');
        }
        
        return "login failed";
    }

   
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()
            ->route('login')
            ->with('status', 'User has been logged out!');
    }
}
