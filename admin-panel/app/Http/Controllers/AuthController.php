<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('filament.pages.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $response = Http::post('http://127.0.0.1:8080/api/login', [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        $data = $response->json();

        if (isset($data['user']['rol']) && $data['user']['rol'] === 'admin') {
            Session::put('user', $data['user']);
            Session::put('token', $data['token']);
            return redirect()->route('admin.dashboard');
        } else {
            return back()->withErrors(['error' => 'No tienes permisos de administrador']);
        }
    }


    public function logout()
    {
        Session::forget('user'); 
        return redirect()->route('login.form'); 
    }
}
