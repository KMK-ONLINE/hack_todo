<?hh

use Illuminate\Database\Eloquent\Collection;

class :home extends :x:element {

  attribute Collection tasks @required;
  attribute Collection errors;

  protected function render() {

    return
      <layout:base title="Laravel + XHP • TodoMVC">

        <div class="container">
          <div class="col-sm-offset-2 col-sm-8">

            <div class="panel panel-default">
              <div class="panel-heading">
                New Task
              </div>

              <div class="panel-body">
                <!-- Display Validation Errors -->
                <common:errors errors={$this->:errors} />

                <!-- New Task Form -->
                <form action="/task" method="post" class="form-horizontal">
                  <input type="hidden" name="_token" value={csrf_token()} />

                  <!-- Task Name -->
                  <div class="form-group">
                    <label for="task-name" class="col-sm-3 control-label">Task</label>

                    <div class="col-sm-6">
                      <input type="text" name="name" id="task-name" class="form-control" value={old('task')} />
                    </div>
                  </div>

                  <!-- Add Task Button -->
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                      <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i>Add Task
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>


            {$this->renderTasks()}

          </div>
        </div>

      </layout:base>;

  }

  private function renderTasks() {
    if(count($this->:tasks) == 0) {
      return <x:frag />;
    }

    return  <div class="panel panel-default">
              <div class="panel-heading">
                Current Tasks
              </div>

              <div class="panel-body">
                <table class="table table-striped task-table">
                  <thead>
                    <tr>
                      <th>Task</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                    {$this->:tasks->map(function($task) { return $this->renderTask($task); })->all()}
                  </tbody>
                </table>
              </div>
            </div>;
  }

  private function renderTask($task) {
    return  <tr>
              <td class="table-text"><div>{$task->name}</div></td>

              <!-- Task Delete Button -->
              <td>
                <form action={"/task/{$task->id}"} method="post">
                  <input type="hidden" name="_token" value={csrf_token()} />
                  <input type="hidden" name="_method" value="delete" />

                  <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i>Delete
                  </button>
                </form>
              </td>
            </tr>;
  }

}
