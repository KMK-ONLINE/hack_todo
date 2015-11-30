<?hh

use App\Models\Task;

class :task:item extends :x:element {

  attribute Task model @required;

  protected function render() {
    $checked = $this->:model->completed; 

    return
      <li class={ $checked ? 'completed' : '' }>
        <div class="view">
          <form action={"/task/{$this->:model->id}"} method="post">
            <input type="hidden"    name="_token"     value={csrf_token()} />
            <input type="hidden"    name="_method"    value="patch" />
            <input type="hidden"    name="completed"  value="0" />
            <input type="checkbox"  name="completed"  value="1" checked={$checked} class="toggle" />
          </form>

          <label>{$this->:model->name}</label>

          <form action={"/task/{$this->:model->id}"} method="post">
            <input type="hidden" name="_token"  value={csrf_token()} />
            <input type="hidden" name="_method" value="delete" />
            <button type="submit" class="destroy"></button>
          </form>
        </div>

        <form action={"/task/{$this->:model->id}"} method="post">
          <input type="hidden" name="_token"  value={csrf_token()} />
          <input type="hidden" name="_method" value="patch" />
          <input type="text"   name="name"    value={$this->:model->name} class="edit"/>
        </form>
      </li>;
  }

}


