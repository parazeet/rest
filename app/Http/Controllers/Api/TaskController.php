<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use function PHPUnit\Framework\isEmpty;

class TaskController extends Controller
{
    public function index($id)
    {
        $task = Task::where('id', $id)->with('tags')->get();
        if ($task->isEmpty()) return response()->error('data not found', 404);

        return response()->success(TaskResource::collection($task));
    }
}
