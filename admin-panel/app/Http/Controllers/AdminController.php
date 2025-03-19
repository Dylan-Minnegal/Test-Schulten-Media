<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{
    public function showAdminPanel()
    {
        
        $token = session('token');  

        if (!$token) {
            return redirect()->route('login.form')->withErrors(['error' => 'No token.']);
        }

        $response = Http::withToken($token)
            ->get('http://127.0.0.1:8080/api/projects'); 

        if ($response->successful()) {
            $projects = $response->json();  

            dd($projects);

            return view('filament.pages.admin', compact('projects'));
        } else {
            return back()->withErrors(['error' => 'No se pudo obtener los proyectos.']);
        }
    }
}
