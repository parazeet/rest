<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name'];
    protected $dates = ['created_at'];

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task2tag', 'tag_id', 'task_id');
    }
}
