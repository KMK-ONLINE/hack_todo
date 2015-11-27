<?php

class ControllerTestCase extends UnitTestCase {

  public function setUp() {
    parent::setUp();
    Session::start();
  }

}
