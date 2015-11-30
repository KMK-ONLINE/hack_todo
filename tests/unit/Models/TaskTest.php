<?php

use App\Models\Task;

class TaskTest extends UnitTestCase {

  public function test_active() {
    $active =   factory(Task::class)->create(['completed' => false]);
    $inactive = factory(Task::class)->create(['completed' => true]);

    $tasks = Task::active()->lists('id');
    $this->assertContains($active->id, $tasks);
    $this->assertNotContains($inactive->id, $tasks);
  }

}
