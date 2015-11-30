<?hh

namespace Components\Task;

use ComponentTestCase;
use App\Models\Task;

class ItemTest extends ComponentTestCase {

  public function test_has_completed_class_and_form() {
    $task = factory(Task::class)->create();
    $dom = <task:item model={$task} />;
    $this->assertDoesntHaveClass('completed', $dom);
    $this->assertDoesntHaveElement('input[value=1][checked=checked]', $dom);

    $task = factory(Task::class)->create(['completed' => true]);
    $dom = <task:item model={$task} />;
    $this->assertHasClass('completed', $dom);
    $this->assertHasElement('input[value=1][checked=checked]', $dom);
  }

  public function test_has_form_for_updating_name() {
    $task = factory(Task::class)->create();
    $dom = <task:item model={$task} />;
    $this->assertHasElement('form input[name=name]', $dom);
  }

  public function test_has_form_for_destroying() {
    $task = factory(Task::class)->create();
    $dom = <task:item model={$task} />;
    $this->assertHasElement('form input[name=_method][value=delete]', $dom);
  }


}
