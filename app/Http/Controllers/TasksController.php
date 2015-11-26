<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller {

  public function index() {
    return view('tasks', [
      'tasks' => Task::orderBy('created_at', 'asc')->get()
    ]);
  }

  public function store(Request $request) {
    $validator = Validator::make($request->all(), [
      'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
      return redirect('/')
        ->withInput()
        ->withErrors($validator);
    }

    $task = new Task();
    $task->name = $request->name;
    $task->save();

    return redirect('/');
  }

  public function update(Request $request, $id) {
    $task = Task::findOrFail($id);
    $task->name = $request->name;
    $task->save();
    return redirect('/'); 
  }

  public function destroy($id) {
    Task::findOrFail($id)->delete();
    return redirect('/');
  }

}
