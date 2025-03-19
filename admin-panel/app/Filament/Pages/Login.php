<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class Login extends Page
{
    public $email;
    public $password;
    public $error;

    protected static string $view = 'filament.pages.login';

    public function getViewData(): array
    {
        return [
            'show_navigation' => false, 
        ];
    }

    public function submit()
    {
        $response = Http::post('http://127.0.0.1:8080/api/login', [
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if ($data['user']['rol'] === 'admin') {
                Session::put('token', $data['token']);
                Session::put('user', $data['user']);

                return redirect()->route('admin.dashboard');
            } else {
                $this->error = 'No tienes permisos de administrador';
            }
        } else {
            $this->error = 'Credenciales incorrectas';
        }
    }
}
