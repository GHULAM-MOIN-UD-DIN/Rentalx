<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\OtpMail;

class AuthController extends Controller
{
    /* ================= FORM PAGES ================= */
    public function loginForm() { return view("auth.login"); }
    public function signupForm() { return view("auth.signup"); }
    public function otpForm() { return view("auth.verify-otp"); }
    public function forgotForm() { return view("auth.forgot-password"); }
    public function resetForm() { return view("auth.reset-password"); }

    /* ================= LOGIN ================= */
    public function login(Request $req)
    {
        $req->validate([
            'email' => ['required','email'],
            'password' => ['required','min:6']
        ]);

        $user = User::where('email', $req->email)->first();

        if($user && Hash::check($req->password, $user->password))
        {
            // Admin -> OTP first (DON'T LOGIN YET)
            if($user->role == 'admin') {
                $otp = rand(100000,999999);
                $user->update([
                    'otp'=>$otp,
                    'otp_expire'=>now()->addMinutes(5)
                ]);
                
                try {
                    Mail::to($user->email)->send(new OtpMail($otp));
                } catch (\Exception $e) {
                    // Log error if mail fails
                }

                session(['temp_user_id' => $user->id, 'otp_type' => 'login']);
                return redirect("/verify-otp")->with("success", "OTP sent to your email.");
            }

            // Normal user -> direct login
            Auth::login($user);
            return redirect("/");
        }

        return back()->with("error","Invalid Login Credentials");
    }

/* ================= VERIFY OTP ================= */
public function verifyOtp(Request $req)
{
    $req->validate(['otp'=>'required|digits:6']);
    $type = session('otp_type');
    
    // Get user from session (for login or forgot password)
    if($type == 'forgot') {
        $user = User::find(session('reset_user'));
    } elseif($type == 'login') {
        $user = User::find(session('temp_user_id'));
    } else {
        $user = Auth::user();
    }
    
    if(!$user) return redirect("/login")->with("error","Session expired or user not found");

    if($user->otp == $req->otp && $user->otp_expire > now())
    {
        $user->update(['otp'=>null,'otp_expire'=>null]);

        if($type == "login") {
            Auth::login($user); // Finally log them in
            session()->forget('temp_user_id');
            
            if($user->role == "admin") 
                return redirect("/admin/dashboard");
            return redirect("/");
        }

        if($type == "forgot") {
            return redirect("/reset-password")->with("success","OTP verified. Please set new password.");
        }

        return redirect("/reset-password");
    }

    return back()->with("error","Invalid or Expired OTP");
}

    /* ================= SIGNUP ================= */
    public function signup(Request $req)
    {
        $req->validate([
            'name' => ['required','regex:/^[a-zA-Z\s]+$/'],
            'email' => ['required','email','unique:users'],
            'password' => ['required','min:6','confirmed']
        ]);

        User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>Hash::make($req->password),
            'role'=>"user"
        ]);

        return redirect("/login")->with("success","Account Created");
    }

    /* ================= FORGOT PASSWORD ================= */
    public function sendForgotOtp(Request $req)
    {
        $req->validate(['email'=>'required|email']);

        $user = User::where("email",$req->email)->first();
        if(!$user) return back()->with("error","Email not registered");

        $otp = rand(100000,999999);
        $user->update(['otp'=>$otp,'otp_expire'=>now()->addMinutes(5)]);

        Mail::to($user->email)->send(new OtpMail($otp));

        session(['reset_user'=>$user->id,'otp_type'=>'forgot']);
        return redirect("/verify-otp");
    }


    

    /* ================= RESET PASSWORD ================= */
    public function resetPassword(Request $req)
    {
        $req->validate(['password'=>'required|min:6|confirmed']);

        $user = User::find(session('reset_user'));
        if(!$user) return redirect("/forgot-password");

        $user->update([
            'password'=>Hash::make($req->password),
            'otp'=>null,
            'otp_expire'=>null
        ]);

        session()->forget(['reset_user','otp_type']);
        return redirect("/login")->with("success","Password Reset Successfully");
    }

    /* ================= LOGOUT ================= */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/login");
    }



public function users()
{
    $users = User::latest()->get();

    return view("Admin.users", compact("users"));
}

}
