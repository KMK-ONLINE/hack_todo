<?php

namespace App\Models;

class TaskTest extends UnitTestCase {

  public function test_active() {
    $default =  factory(Task::class)->create(['completed' => null]);
    $active =   factory(Task::class)->create(['completed' => false]);
    $inactive = factory(Task::class)->create(['completed' => true]);

    $tasks = Task::active()->lists('id');
    $this->assertContains($default->id, $tasks);
    $this->assertContains($active->id, $tasks);
    $this->assertNotContains($inactive->id, $tasks);
  }

  public function test_completed() {
    $default =  factory(Task::class)->create(['completed' => null]);
    $active =   factory(Task::class)->create(['completed' => false]);
    $inactive = factory(Task::class)->create(['completed' => true]);

    $tasks = Task::completed()->lists('id');
    $this->assertNotContains($default->id, $tasks);
    $this->assertNotContains($active->id, $tasks);
    $this->assertContains($inactive->id, $tasks);
  }
}
