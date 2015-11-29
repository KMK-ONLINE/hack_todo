<?hh

use Illuminate\Database\Eloquent\Collection;

class :common:errors extends :x:element {

  attribute Collection errors;

  protected function render() {
    if(count($this->:errors) == 0) {
      return <x:frag />;
    }

    return  <div class="alert alert-danger">
              <strong>Whoops! Something went wrong!</strong>
              <br />
              <br />
              <ul>{$this->items()}</ul>
            </div>;
  }

  private function items() {
    return $this->:errors->map(function($error) {
      return <li>{$error}</li>;
    })->all();
  }

}
