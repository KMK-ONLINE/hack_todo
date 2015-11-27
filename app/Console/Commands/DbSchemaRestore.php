<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
// use Woodling\Woodling;
use Config;
use DB;

class DbSchemaRestore extends Command {

  protected $signature = 'db:schema:restore
                          {--schema-file=database/schema.sql}';

  protected $description = 'Restore database/schema.sql for development.';

  public function handle() {
    $schemaFile = $this->option('schema-file');

    $dbConfig = Config::get('database.connections.pgsql');
    $restoreCommand = "pg_restore -c -d {$dbConfig['database']} -U {$dbConfig['username']} -h {$dbConfig['host']} {$schemaFile}";

    $this->info($restoreCommand);
    shell_exec($restoreCommand);

    // $this->restoreWoodlingCounters();
  }

  // public function restoreWoodlingCounters() {
  //   $dumpFile = base_path('tests/_data/testing.seq');
  //   $results = json_decode(file_get_contents($dumpFile), true);
  //   $stores = Woodling::getCore()->repository->getStore();
  //   foreach($stores as $name=>$factory) {
  //     if (array_key_exists($name, $results)) {
  //       $sequencer = $factory->getRunner()->getSequencer();
  //       $sequencer->setCounters($results[$name]);
  //     }
  //   }
  // }

}
