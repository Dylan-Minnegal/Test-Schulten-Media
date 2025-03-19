<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ProjectService
{
    public function getProjects($token)
    {
        $response = Http::withToken($token)->get('http://127.0.0.1:8080/api/projects');

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
