<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json(['message' => 'No autorizado.'], 401); 
        }

        if ($user->rol !== 'admin') {
            return response()->json(['message' => 'No autorizado.'], 403);
        }

        return $next($request);
    }
}
