<?hh

namespace App\Http\Controllers;

use URL;
use App\Models\Task;
use ControllerTestCase;

class TaskControllerTest extends ControllerTestCase {

    public function test_index_has_all_tasks() {
      factory(Task::class)->create(['name' => 'Task 1']);
      factory(Task::class)->create(['name' => 'Task 2']);

      $path = URL::route('task.index');
      $this->get($path);

      $this->assertResponseStatus(200);

      $expectedTaskIds = Task::orderBy('created_at', 'asc')->lists('id')->all();
      $actualTaskIds = $this->response->original->:collection->fetch('id')->all();
      $this->assertEquals($expectedTaskIds, $actualTaskIds);
    }

    public function test_index_with_filtering() {
      $activeTask = factory(Task::class)->create([]);
      $inactiveTask = factory(Task::class)->create(['completed' => true]);

      $path = URL::route('task.index', ['filter' => 'active']);
      $this->get($path);
      $this->assertResponseStatus(200);

      $actualTaskIds = $this->response->original->:collection->fetch('id')->all();
      $this->assertContains($activeTask->id, $actualTaskIds);
      $this->assertNotContains($inactiveTask->id, $actualTaskIds);


      $path = URL::route('task.index', ['filter' => 'completed']);
      $this->get($path);
      $this->assertResponseStatus(200);

      $actualTaskIds = $this->response->original->:collection->fetch('id')->all();
      $this->assertNotContains($activeTask->id, $actualTaskIds);
      $this->assertContains($inactiveTask->id, $actualTaskIds);
    }

    public function test_store() {
      $name = 'Wash Dishes';

      $path = URL::route('task.store');
      $this->post($path, [ 'name' => $name, '_token' => csrf_token() ]);

      $this->assertResponseStatus(302);

      $task = Task::orderBy('id', 'desc')->first();
      $this->assertEquals($name, $task->name);
    }

    public function test_store_with_invalid_data() {
      $name = str_random(300);

      $path = URL::route('task.store');
      $this->post($path, [ 'name' => $name, '_token' => csrf_token() ]);

      $this->assertResponseStatus(302);
      $this->assertEquals(0, Task::count());
    }

    public function test_update_name_and_completed() {
      $task = factory(Task::class)->create(['completed' => false ]);
      $updatedName = 'Feed Cat';

      $path = URL::route('task.update', ['id' => $task->id ]);
      $this->put($path, [ 'name' => $updatedName, 'completed' => true, '_token' => csrf_token() ]);

      $this->assertResponseStatus(302);

      $updatedTask = Task::find($task->id);
      $this->assertEquals($updatedName, $updatedTask->name);
      $this->assertTrue($updatedTask->completed);
    }

}
