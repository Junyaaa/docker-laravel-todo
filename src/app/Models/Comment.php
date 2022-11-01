<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Comment extends Model
{
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
        // return $this->hasMany('App\Models\Task', 'folder_id', 'task_id', 'id');

    }

    /**
     * 削除処理
     */
    public function deleteCommentById($comment)
    {
        return $this->destroy($comment);
    }
}

