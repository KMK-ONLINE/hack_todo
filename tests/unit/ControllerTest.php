<?php

namespace App\Http\Controllers;

use TestCase;
use Session;
use URL;
use App\Models\Task;

class TaskTest extends TestCase {

    public function setUp() {
      parent::setUp();
      Session::start();
    }

    public function test_index() {
      $path = URL::route('root');
      $response = $this->get($path);
      $this->assertResponseStatus(200);
    }

    public function test_store() {
      $name = 'Wash Dishes';

      $path = URL::route('tasks.store');
      $response = $this->post($path, [ 'name' => $name, '_token' => csrf_token() ]);

      $this->assertResponseStatus(302);

      $task = Task::orderBy('id', 'desc')->first();
      $this->assertEquals($name, $task->name);
    }

}
