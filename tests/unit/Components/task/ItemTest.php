<?hh

namespace Components\Task;

use ComponentTestCase;
use App\Models\Task;

class ItemTest extends ComponentTestCase {

  public function test_has_completed() {
    $task = factory(Task::class)->create();
    $dom = <task:item model={$task} />;
    $this->assertDoesntHaveClass('completed', $dom);

    $task = factory(Task::class)->create(['completed' => true]);
    $dom = <task:item model={$task} />;
    $this->assertHasClass('completed', $dom);
  }

}
