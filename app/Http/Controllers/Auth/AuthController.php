<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function loginProcess(Request $request) {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required',
        ]);
        // Check if the provided credentials are valid.
        if (auth()->attempt($validated)) {
            // Regenerate the session ID and invalidate the current session.
            $request->session()->regenerate();
            // Redirect the user to the dashboard page with a success message.
            
            if(auth()->user()->role == "admin") {
                return redirect()->route('home');
            } else {
                return redirect()->route('classroom');
            }
            
        } else {
            // Redirect the user back to the login page with an error message.
            return redirect()->route('login')->with('error', 'Invalid credentials. Please try again.');
        }
    }
    // This method is responsible for logging the user out and invalidating their session.
    public function logout(Request $request) {
        // Log the user out.
        auth()->logout();
      
        // Invalidate the current session and regenerate the session ID.
        $request->session()->invalidate();
        $request->session()->regenerateToken();
      
        // Redirect the user back to the home page with a success message.
        return redirect()->route('home')->with('message', 'Logout Success');
    }
    
    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleCallback() {
        try {
          $user = Socialite::driver('google')->user();
          
          $finduser = User::where('googleID', $user->id)->first();
          if($finduser) {
            Auth::login($finduser);
            return redirect('/users/home');
          } else {
            $finduser = User::where('email', $user->email)->first();
            if($finduser) {
              User::where('email', $user->email)
              ->update([
                'googleID'          => $user->id, 
                'googleConnect'     => 'connected', 
                'email_verified_at' => date('Y-m-d')
              ]);  
              
              $getUserData = User::where('googleID', $user->id)->first();
              Auth::login($getUserData);
              return redirect('/users/home');
            } else {
              return redirect('/')->with('error', "Invalid Account");
            }
          }
        } catch (Exception $e) {
          dd($e->getMessage());
        }
    }
}
