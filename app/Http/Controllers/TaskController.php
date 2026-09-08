<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();

        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index');
    }

    public function toggle(Task $task): RedirectResponse
    {
        $task->update(['is_done' => ! $task->is_done]);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
