<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId);  
        return response()->json($project->tasks);  
    }

    public function store(Request $request, $projectId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::findOrFail($projectId);  

        $task = $project->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => false,  
        ]);

        return response()->json([
            'message' => 'Task created successfully!',
            'task' => $task
        ], 201);
    }

    public function show($projectId, $taskId)
    {
        $project = Project::findOrFail($projectId);  
        $task = $project->tasks()->findOrFail($taskId);  

        return response()->json($task);
    }

    public function update(Request $request, $projectId, $taskId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'nullable|boolean',
        ]);

        $project = Project::findOrFail($projectId);  
        $task = $project->tasks()->findOrFail($taskId);  

        $task->update($request->only('title', 'description', 'completed'));

        return response()->json([
            'message' => 'Task updated successfully!',
            'task' => $task
        ]);
    }

    public function destroy($projectId, $taskId)
    {
        $project = Project::findOrFail($projectId);  
        $task = $project->tasks()->findOrFail($taskId);

        $task->delete();  

        return response()->json([
            'message' => 'Task deleted successfully!'
        ]);
    }
}
