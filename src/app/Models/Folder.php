<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Folder extends Model
{
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
