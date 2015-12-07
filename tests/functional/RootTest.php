<?php

use App\Models\Task;

class RootTest extends FunctionalTestCase {

  public function test_tasks_are_displayed_on_the_dashboard() {
    factory(Task::class)->create(['name' => 'Task 1']);
    factory(Task::class)->create(['name' => 'Task 2']);
    factory(Task::class)->create(['name' => 'Task 3']);

    $this->visit('/')
         ->see('Task 1')
         ->see('Task 2')
         ->see('Task 3');
  }

  public function test_tasks_can_be_created() {
    $this->visit('/')
         ->dontSee('Task 1');

    $form = $this->crawler->filter('form[method=post]')->form();
    $form->setValues([ 'name' => 'Task 1' ]);
    $this->makeRequestUsingForm($form);

    // $this->visit('/')
    //     ->type('Task 1', 'name')
    //     ->press('Add Task');

    $this->see('Task 1');
  }

  //
  // TODO: Need to find a way for XHP to access the errors
  // from the request validation.  Maybe @guiltry knows?
  //
  // public function test_long_tasks_cant_be_created() {
  //   $this->visit('/');
  //
  //   $form = $this->crawler->filter('form[method=post]')->form();
  //   $form->setValues([ 'name' => str_random(300) ]);
  //   $this->makeRequestUsingForm($form);
  //
  //   // $this->visit('/')
  //   //     ->type(str_random(300), 'name')
  //   //     ->press('Add Task');
  //
  //   $this->see('Whoops!');
  // }
}
