<?hh

use Illuminate\Database\Eloquent\Collection;

class :home extends :x:element {

  attribute Collection tasks @required;
  attribute Collection errors;

  protected function render() {

    return
      <layout:base title="Laravel + XHP • TodoMVC">

        <common:errors errors={$this->:errors} />

        <header class="header">
          <h1>todos</h1>

          <form action="/tasks" method="post">
            <input type="hidden" name="_token" value={csrf_token()} />
            <input type="text"   name="name"   value={old('task')} class="new-todo" placeholder="What needs to be done?" />
          </form>
        </header>

        {$this->renderTasks()}

        <footer class="footer">
          <span class="todo-count">
            <strong>{count($this->:tasks)}</strong> items left
          </span>
          <ul class="filters">
            <li>
              <a class="selected" href="#/">All</a>
            </li>
            <li>
              <a class="" href="#/active">Active</a>
            </li>
            <li>
              <a class="" href="#/completed">Completed</a>
            </li>
          </ul>
          <button class="clear-completed">Clear completed</button>
        </footer>

      </layout:base>;

  }

  private function renderTasks() {
    if(count($this->:tasks) == 0) {
      return <x:frag />;
    }

    return
      <section class="main">
        <input class="toggle-all" type="checkbox"></input>
        <ul class="todo-list">
          {$this->:tasks->map(function($task) { return $this->renderTask($task); })->all()}
        </ul>
      </section>;

  }

  private function renderTask($task) {
    return
      <li class={ $task->completed ? 'completed' : '' }>
        <div class="view">
          <input class="toggle" type="checkbox" />
          <label>{$task->name}</label>

          <form action={"/tasks/{$task->id}"} method="post">
            <input type="hidden" name="_token" value={csrf_token()} />
            <input type="hidden" name="_method" value="delete" />
            <button type="submit" class="destroy"></button>
          </form>

        </div>
        <input class="edit" value={$task->name} />
      </li>;
  }

}
