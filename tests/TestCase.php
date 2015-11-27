<?php

use Symfony\Component\Console\Output\ConsoleOutput;

class TestCase extends Illuminate\Foundation\Testing\TestCase {

  /**
   * The base URL to use while testing the application.
   *
   * @var string
   */
  protected $baseUrl = 'http://localhost';

  /**
   * Creates the application.
   *
   * @return \Illuminate\Foundation\Application
   */
  public function createApplication() {
    $app = require __DIR__.'/../bootstrap/app.php';

    $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

    return $app;
  }

  /**
   * @before
   */
  public function runDatabaseMigrations() {
    if($GLOBALS['run_database_migrations']) { return; }
    $GLOBALS['run_database_migrations'] = true;

    $output = new ConsoleOutput();

    if (getenv('DUMP_SCHEMA') == 1) {

      $output->writeln("Cleaning Database with artisan's <bg=green;options=bold>db:fix && db:schema:dump</>...");

      $this->artisan('db:fix');
      $this->artisan('db:schema:dump', [
        '--output-file' => 'tests/_data/dump.sql',
        '--binary' => 'true'
      ]);

    } else {

      $output->writeln("Restoring Database with artisan's <bg=green;options=bold>db:schema:restore</>...");

      $this->artisan('db:schema:restore', [
        '--schema-file' => 'tests/_data/dump.sql'
      ]);

    }
  }
}
