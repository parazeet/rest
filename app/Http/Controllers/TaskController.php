<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Task;
use App\Http\Requests\CreateTaskRequest;



class TaskController extends Controller
{
    public const TASK_PER_PAGE = 3;

    public function index()
    {
        $tags = Tag::where('user_id', auth()->id())->orderByDesc('created_at')->get();
        $tasks = Task::where('user_id', auth()->id())
            ->with('tags')
            ->orderByDesc('created_at')
            ->paginate(self::TASK_PER_PAGE);

        return view('index', compact('tasks', 'tags'));
    }

    public function store(CreateTaskRequest $request)
    {
        $task = Task::create([
            'user_id' => auth()->id(),
            'name' => $request->task_name,
            'description' => $request->description,
        ]);

        if ($request->tags) {
            $task->tags()->attach($request->tags);
        }

        return redirect()->back()->with('message', 'Задача успешно добавлена!');
    }
}
