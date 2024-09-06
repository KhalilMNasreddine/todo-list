<?php

namespace App\Http\Controllers;
use App\Models\Todo;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function createTask(Request $request){
        $incomingFields=$request->validate(
            [
                'title'=>'required',
            ]
            );
        $incomingFields['title']=strip_tags($incomingFields['title']);
        $incomingFields['user_id']=auth()->id();
        Todo::create($incomingFields);
        return redirect('/todo');
    }

    public function editTask(Request $request, $id) {
        $task = Todo::find($id);
        if ($task) {
            $task->title = $request->input('title');
            $task->save();
            return redirect()->route('showAllTasks');
        } else {
            return redirect()->route('showAllTasks')->with('error', 'Task not found');
        }
    }
    
    public function deleteTask($id) {
        $task = Todo::find($id);
        if ($task) {
            $task->delete();
            return redirect()->route('showAllTasks');
        } else {
            return redirect()->route('showAllTasks')->with('error', 'Task not found');
        }
    }

    public function showAllTasks(){
    $tasks = Todo::all();
    if ($tasks->isEmpty()) {
        $tasks = null;
    }
    return view('todo', ['tasks' => $tasks]);
}
}
