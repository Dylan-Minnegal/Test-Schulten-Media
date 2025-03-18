<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;


class ProjectsController extends Controller
{
    
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::create($request->only('name', 'description'));
        return response()->json($project, 201); 
    }

   
    public function store(Request $request)
    {
        
    }

    
    public function show(string $id)
    {
        
    }

    
    public function edit(string $id)
    {
        
    }

  
    public function update(Request $request, string $id)
    {
        
    }

    
    public function destroy(string $id)
    {
        
    }
}
