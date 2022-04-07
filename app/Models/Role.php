<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';
    public $timestamps = false;

    public function getIsAdminAttribute(): bool
    {
        return ($this->name == self::ROLE_ADMIN);
    }

    public function getIsUserAttribute(): bool
    {
        return ($this->name == self::ROLE_USER);
    }
}
