<?php
namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Login extends Page
{
    protected static string $view = 'filament.pages.login';

    public function mount()
    {
        if (Auth::check()) {
            return redirect()->route('filament.dashboard');
        }
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validated)) {
            return redirect()->route('filament.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
}
