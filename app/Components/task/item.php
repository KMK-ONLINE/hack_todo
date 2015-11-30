<?hh

use App\Models\Task;

class :task:item extends :x:element {

  attribute Task model @required;

  protected function render() {
    return
      <li class={ $this->:model->completed ? 'completed' : '' }>
        <div class="view">

          <form action={"/task/{$this->:model->id}"} method="post">
            <input type="hidden" name="_token" value={csrf_token()} />
            <input type="hidden" name="_method" value="put" />
            <input class="toggle" type="checkbox" />
          </form>

          <label>{$this->:model->name}</label>

          <form action={"/task/{$this->:model->id}"} method="post">
            <input type="hidden" name="_token" value={csrf_token()} />
            <input type="hidden" name="_method" value="delete" />
            <button type="submit" class="destroy"></button>
          </form>

        </div>
        <input class="edit" value={$this->:model->name} />
      </li>;
  }

}
