<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        if(session()->has('user')){
            return redirect()->route('dashboard');
        }
        return view('index');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $response = Http::post('https://dummyjson.com/auth/login', [
            'username' => $request->username,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            session(['user' => $response->json()]);
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['username'=>'Invalid credentials']);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(session()->has('user')){
            $user = session('user');
            return view('dashboard', compact('user'));
        }

        return redirect("login")->withErrors('Opps! You do not have access');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout(): RedirectResponse
    {
        Session::flush();

        return Redirect('login');
    }

    public function product(){
        $response = Http::get('https://dummyjson.com/products');
        $data = $response->json()['products']; // Get the products data
        return response()->json(['data' => $data]);
    }
}
