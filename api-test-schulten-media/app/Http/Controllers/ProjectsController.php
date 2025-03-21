<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;


class ProjectsController extends Controller
{

    public function index()
    {
        return Project::with('tasks.comments')->get();
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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::create($request->only('name', 'description'));
        return response()->json($project, 201);
    }


    public function show(string $id)
    {
        $project = Project::with('tasks')->findOrFail($id);
        return response()->json($project);
    }


    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($request->only('name', 'description'));

        return response()->json([
            'message' => 'Project updated successfully!',
            'project' => $project
        ], 200);
    }



    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return response()->json(['message' => 'Project deleted']);
    }
}
