<?hh

use Illuminate\Database\Eloquent\Collection;

class :task:index extends :x:element {

  attribute Collection collection @required;
  attribute Collection errors;

  protected function render() {

    return
      <layout:base title="Laravel + XHP • TodoMVC">

        <common:errors errors={$this->:errors} />

        <header class="header">
          <h1>todos</h1>

          <form action="/task" method="post">
            <input type="hidden" name="_token" value={csrf_token()} />
            <input type="text"   name="name"   value={old('task')} class="new-todo" placeholder="What needs to be done?" />
          </form>
        </header>

        {$this->renderTasks()}


        <task:footer collection={$this->:collection} />

      </layout:base>;

  }

  private function renderTasks() {
    if(count($this->:collection) == 0) {
      return <x:frag />;
    }

    return
      <section class="main">
        <input class="toggle-all" type="checkbox"></input>
        <ul class="todo-list">
          {$this->:collection->map(function($task) { return $this->renderTask($task); })->all()}
        </ul>
      </section>;

  }

  private function renderTask($task) {
    return
      <li class={ $task->completed ? 'completed' : '' }>
        <div class="view">
          <input class="toggle" type="checkbox" />
          <label>{$task->name}</label>

          <form action={"/task/{$task->id}"} method="post">
            <input type="hidden" name="_token" value={csrf_token()} />
            <input type="hidden" name="_method" value="delete" />
            <button type="submit" class="destroy"></button>
          </form>

        </div>
        <input class="edit" value={$task->name} />
      </li>;
  }

}
