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
              {$this->linkTo(null, 'All')}
            </li>
            <li>
              {$this->linkTo('active', 'Active')}
            </li>
            <li>
              {$this->linkTo('completed', 'Completed')}
            </li>
          </ul>
          <button class="clear-completed">Clear completed</button>
        </footer>;
  }

  private function linkTo($filter, $title) {
    $urlParams = $filter ? ['filter' => $filter ] : [];
    $cssClass = Input::get('filter') == $filter ? 'selected' : '';

    return <a class={$cssClass} href={URL::route('task.index', $urlParams)}>{$title}</a>;
  }
}
