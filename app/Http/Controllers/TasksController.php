<?hh

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;

class TasksController extends Controller {

  public function index(TaskRequest $request) {
    $tasks = Task::orderBy('created_at', 'asc');

    $params = $this->strongParams($request, ['filter']);

    if ($params['filter'] == 'active') {
      $tasks = $tasks->active();
    }

    if ($params['filter'] == 'completed') {
      $tasks = $tasks->completed();
    }

    return <home tasks={$tasks->get()} />;
  }

  public function store(Request $request) {
    $validator = Validator::make($request->all(), [
      'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
      $tasks = Task::orderBy('created_at', 'asc')->get();
      $errors = new Collection($validator->errors()->toArray());
      return <home tasks={$tasks} errors={$errors} />;
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
