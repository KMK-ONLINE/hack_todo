<?hh

use App\Models\Task;

class TaskControllerTest extends ControllerTestCase {

    public function test_index_has_all_tasks() {
      factory(Task::class)->create(['name' => 'Task 1']);
      factory(Task::class)->create(['name' => 'Task 2']);

      $path = URL::route('task.index');
      $response = $this->get($path);

      $this->assertResponseStatus(200);

      $expectedTaskIds = Task::orderBy('created_at', 'asc')->lists('id')->all();
      $actualTaskIds = $this->response->original->:collection->fetch('id')->all();
      $this->assertEquals($expectedTaskIds, $actualTaskIds);
    }

    public function test_index_with_filtering() {
      $activeTask = factory(Task::class)->create([]);
      $inactiveTask = factory(Task::class)->create(['completed' => true]);

      $path = URL::route('task.index', ['filter' => 'active']);
      $response = $this->get($path);
      $this->assertResponseStatus(200);

      $actualTaskIds = $this->response->original->:collection->fetch('id')->all();
      $this->assertContains($activeTask->id, $actualTaskIds);
      $this->assertNotContains($inactiveTask->id, $actualTaskIds);


      $path = URL::route('task.index', ['filter' => 'completed']);
      $response = $this->get($path);
      $this->assertResponseStatus(200);

      $actualTaskIds = $this->response->original->:collection->fetch('id')->all();
      $this->assertNotContains($activeTask->id, $actualTaskIds);
      $this->assertContains($inactiveTask->id, $actualTaskIds);
    }

    public function test_store() {
      $name = 'Wash Dishes';

      $path = URL::route('task.store');
      $response = $this->post($path, [ 'name' => $name, '_token' => csrf_token() ]);

      $this->assertResponseStatus(302);

      $task = Task::orderBy('id', 'desc')->first();
      $this->assertEquals($name, $task->name);
    }

    public function test_update() {
      $name = 'Wash Dishes';
      $updatedName = 'Feed Cat';

      $task = new Task();
      $task->name = $name;
      $task->save();

      $path = URL::route('task.update', ['id' => $task->id ]);
      $response = $this->put($path, [ 'name' => $updatedName, '_token' => csrf_token() ]);

      $this->assertResponseStatus(302);

      $updatedTask = Task::find($task->id);
      $this->assertEquals($updatedName, $updatedTask->name);
    }

}
