<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class Tasks extends Component
{
    use WithPagination;

    public const TASK_PER_PAGE = 3;
    public Task $task;
    public $showModel = false;
    public $sortName = 'created_at';
    public $sortAsc = true;
    protected $paginationTheme = 'bootstrap';
    protected $rules = [
        'task.description' => 'required|string|min:5',
        'task.status' => 'required|boolean',
    ];

    public function render()
    {
        $tasks = Task::orderBy($this->sortName, $this->sortAsc ? 'asc' : 'desc')->paginate(self::TASK_PER_PAGE);

        return view('livewire.tasks', compact('tasks'));
    }

    public function show(Task $task)
    {
        $this->showModel = true;
        $this->task = $task;
    }

    public function update(Task $task)
    {
        $this->validate();
        $this->task->save();

        $this->close();
    }

    public function delete(Task $task)
    {
        @unlink(public_path($task::TASK_IMG_PATH . $task->img));
        $task->delete();
    }

    public function sortBy($field)
    {
        $this->sortAsc = !($this->sortName === $field) || !$this->sortAsc;
        $this->sortName = $field;
    }


    public function close()
    {
        $this->reset('showModel');
    }
}
