<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\CreateTaskRequest;
use Intervention\Image\ImageManagerStatic as Image;

class TaskController extends Controller
{
    public const TASK_PER_PAGE = 3;

    public function index()
    {
        $tasks = Task::orderBy('created_at')->paginate(self::TASK_PER_PAGE);

        return view('index', compact('tasks'));
    }

    public function store(CreateTaskRequest $request)
    {
        $task = Task::create([
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description,
        ]);

        if ($request->hasFile('img')) {
            $this->saveImg($task, $request);
        }

        return redirect()->back()->with('message', 'Задача успешно добавлена!');
    }

    private function saveImg(Task $task, CreateTaskRequest $request)
    {
        try{
            $img = $request->img;
            $ext = $img->getClientOriginalExtension();
            $path = $task::TASK_IMG_PATH . $task->id . '.' . $ext;

            if (!is_dir(public_path($task::TASK_IMG_PATH))) {
                mkdir(public_path($task::TASK_IMG_PATH), 0777, true);
            }

            $imgResize = Image::make($img->getRealPath());
            $imgResize->resize(320,240, function ($constraint) {
                $constraint->aspectRatio();
            });
            $imgResize->save(public_path($path));

            // тут могли б отправлять файл в облако и удалять локально

            $task->img = $task->id . '.' . $ext;
            $task->save();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Не удалось сохранить картинку!');
        }
    }
}
