<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Task;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use App\Models\Comment;
use App\Http\Requests\CommentTask;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

    /**
     * コメント一覧
     * @param Folder $folde
     * @param Task $task
     * @return \Illuminate\View\View
     */
    public function comment(Folder $folder, Task $task)
    {

        // ユーザーのフォルダを取得する
        $folders = Auth::user()->folders()->get();

        // ユーザーのタスクを取得する
        $tasks = Auth::user()->tasks()->get();

        // 選ばれたフォルダに紐づくタスクを取得する
        $tasks = $folder->tasks()->get();

        // // 選ばれたタスクに紐づくフォルダを取得する
        $comments = $task->comments()->get();

        return view('comments/comment', [
            'folders' => $folders,
            'tasks' => $tasks,
            'current_folder_id' => $folder->id,
            'current_task_id' => $task->id,
            'comments' => $comments,

        ]);
    }


    /**
     * コメント作成フォーム
     * @param  Task $task
     * @return \Illuminate\View\View
     */
    public function showCreateForm(Folder $folder, Task $task, Comment $request)
    {
        return view('comments/create', [
            'task' => $task,
            'folder' => $folder,
            // 'comment' => $comment,

        ]);
    }

    /**
     * コメント作成
     * @param Task $task
     * @param CommentTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Folder $folder, Task $task, CommentTask $request)
    {
        $comment = new Comment();
        $comment->text = $request->text;
        $comment->folder_id=$folder->id;
        $comment->task_id=$task->id;
        $comment->save();
        // $folder->tasks()->comments()->save($comment);
        // $folder->tasks()->save($task);

        return redirect()->route('comments.comment', [
            'folder' => $folder->id,
            'task' => $task->id,

        ]);
    }


    /**
     * コメント編集フォーム
     * @param Folder $folder
     * @param Task $task
     * @param Comment $comment
     * @return \Illuminate\View\View
     */
    public function showEditForm(Folder $folder, Task $task, Comment $comment)
    {
        // $this->checkRelation($folder, $task, $comment);

        return view('comments/edit', [
            'task' => $task,
            'comment' => $comment,
        ]);
    }

    /**
     * コメント編集
     * @param Folder $folder
     * @param Task $task
     * @param Comment $comment
     * @param EditComment $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Folder $folder, Task $task, Comment $comment, CommentTask $request)
    {
        // $this->checkRelation($folder, $task);

        $comment->text = $request->text;
        $comment->save();

        return redirect()->route('comments.comment', [
            'folder' => $task->folder_id,
            'task' => $comment->task_id,
            'comment' => $comment,
        ]);
    }



    /**
    * コメント削除
    * Remove the specified resource from storage.

     * @param Folder $folder
     * @param Task $task
     * @param Comment $comment
    * @return \Illuminate\Http\Response
    */
    public function destroy(Folder $folder, Task $task, Comment $comment)
    {
        $deletecomment = $comment->comment->deleteCommentById($comment);

        // $comment = Comment::find($id);
        // $comment->destroy($id);

        // $comment->comment->destroy();
        // Comment::where('comment', $comment)->delete();


        // return redirect('comments.comment');
        return redirect()->route('comments.comment$ $', [
            'folder' => $folder->folder_id,
            'task' => $task,
            'comment' => $comment,
            'id' => $comment->id,

        ]);
    }

    public function __construct(deleteCommentById $deletecomment){

        $deletecomment = $comment->comment->deleteCommentById($comment);


    }


}
