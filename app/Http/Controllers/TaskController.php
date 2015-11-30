<?hh

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;

class TaskController extends Controller {

  public function index(TaskRequest $request) {
    $tasks = Task::orderBy('created_at', 'asc');

    $params = $this->strongParams($request, ['filter'], true);

    if ($params['filter'] == 'active') {
      $tasks = $tasks->active();
    }

    if ($params['filter'] == 'completed') {
      $tasks = $tasks->completed();
    }

    return <task:index collection={$tasks->get()} />;
  }

  public function store(Request $request) {
    $validator = Validator::make($request->all(), [
      'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
      $tasks = Task::orderBy('created_at', 'asc')->get();
      $errors = new Collection($validator->errors()->toArray());
      return <task:index collection={$tasks} errors={$errors} />;
    }

    $task = new Task();
    $task->name = $request->name;
    $task->save();

    return redirect('/');
  }

  public function update(TaskRequest $request, $id) {
    $task = Task::findOrFail($id);
    $params = $this->strongParams($request, ['name', 'completed']);
    $task->fill($params);
    $task->save();

    return redirect('/');
  }

  public function destroy($id) {
    Task::findOrFail($id)->delete();
    return redirect('/');
  }

}
