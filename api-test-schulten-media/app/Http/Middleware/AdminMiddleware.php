<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Filament\Exceptions\AccessDeniedException;


class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->rol !== 'admin') {
            return redirect()->route('filament.auth.login')->withErrors([
                'email' => 'You must be an admin to access the panel.',
            ]);
        }

        return $next($request);
    }
}
