<?hh

use Illuminate\Database\Eloquent\Collection;

class :task:footer extends :x:element {

  attribute Collection collection @required;

  protected function render() {

    return
        <footer class="footer">
          <span class="todo-count">
            <strong>{count($this->:collection)}</strong> items left
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
        </footer>;
    }

}
