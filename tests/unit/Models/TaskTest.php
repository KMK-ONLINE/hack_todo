<?php

use App\Models\Task;

class TaskTest extends UnitTestCase {

  public function test_transactions() {
    $this->assertEquals(0, Task::count());

    $task = new Task();
    $task->name = "Wash Dishes";
    $task->save();

    $this->assertEquals(1, Task::count());
  }

  public function test_isValid() {
    $task = new Task();
    $this->assertFalse($task->isValid());

    $task->name = "Wash Dishes";
    $this->assertTrue($task->isValid());

    $task->name = str_repeat("Wash Dishes", 100);
    $this->assertFalse($task->isValid());
  }

}
