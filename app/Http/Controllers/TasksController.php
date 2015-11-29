<?hh

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;

class TasksController extends Controller {

  public function index() {
    $tasks = Task::orderBy('created_at', 'asc')->get();
    return <home tasks={$tasks} />;
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
