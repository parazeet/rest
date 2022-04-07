<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    const TASK_IMG_PATH = '/img/tasks_img/';

    protected $fillable = [
        'name',
        'email',
        'description',
        'img',
        'status'
    ];

    public function getImg()
    {
        if (empty(trim($this->img))) {
            return self::TASK_IMG_PATH . 'default_img.png';
        }

        return self::TASK_IMG_PATH . $this->img;
    }
}
