<?php
namespace App\Http\Controllers;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomAuthController extends Controller
{
    function __construct(){}

    /**
     * Check if user is logged in and redirect to devicelog
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if(Auth::check()){

            $path = \Illuminate\Support\Facades\Request::path();

            if($path == '/') {
                return redirect()->intended('/admin');
            } else {
                return redirect()->back();
            }
        } else {
            return view('auth.login');
        }
    }  

    /**
     * Try to login
     *
     * @return \Illuminate\Http\Response
     */

    public function customLogin(Request $request)
    {
        $request->validate(['email' => 'required','password' => 'required']);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $path = \Illuminate\Support\Facades\Request::path();

            if($path == '/') {
                return redirect()->intended('/admin');
            } else {
                return redirect()->back();
            }
        }
        return redirect("/")->withSuccess('Login details are not valid');
    }

    /**
     * Logout
     *
     * @return \Illuminate\Http\Response
     */

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('/');
    }
}