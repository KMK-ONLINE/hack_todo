<?php

use App\Task;

class TaskTest extends TestCase {

    public function test_isValid() {
      $task = new Task();
      $this->assertFalse($task->isValid());

      $task->name = "Wash Dishes";
      $this->assertTrue($task->isValid());

      $task->name = str_repeat("Wash Dishes", 100);
      $this->assertFalse($task->isValid());
    }

}
