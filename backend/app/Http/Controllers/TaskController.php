<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return response()->json($tasks);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);

        return response()->json($task);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'user_id' => 'required|exists:users,id'
        ]);

        $task = new Task();

        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = "pending";
        $task->user_id = $request->user_id;

        $task->save();

        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required',
            'user_id' => 'required|exists:users,id'
        ]);

        $task = Task::findOrFail($id);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->user_id = $request->user_id;

        $task->save();

        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully'
        ]);
    }

    public function getUserTasks($userId)
    {
        $tasks = Task::where('user_id', $userId)->get();

        return response()->json($tasks);
    }
}
