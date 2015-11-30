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

  public function store(TaskRequest $request) {
    $params = $this->strongParams($request, ['name']);
    $task = Task::create($params);
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
