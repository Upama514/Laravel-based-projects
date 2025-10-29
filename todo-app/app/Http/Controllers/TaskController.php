<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // সব task দেখাবে
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    // নতুন task form দেখাবে
    public function create()
    {
        return view('tasks.create');
    }

    // নতুন task save করবে
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->has('is_completed') ? true : false
        ]);

        return redirect()->route('tasks.index');
    }

    // task edit form দেখাবে
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // task update করবে
    public function update(Request $request, Task $task)
   {
    $request->validate([
        'title' => 'required'
    ]);

    $task->update([
        'title' => $request->title,
        'description' => $request->description,
        'is_completed' => $request->has('is_completed') ? true : false
    ]);

    return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    // task delete করবে
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function toggleComplete(Task $task)
    {
    $task->update([
        'is_completed' => !$task->is_completed
    ]);
    return redirect()->route('tasks.index');
    } 

    public function about()
    {
    return view('tasks.about');
    }

}
