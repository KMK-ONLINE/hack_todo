<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Config;

class DbSchemaDump extends Command {

  protected $signature = 'db:schema:dump
                          {--output-file=database/schema.sql}
                          {--binary=false}';

  protected $description = 'Create a database/schema.sql for development.';

  public function handle() {
    $dumpFile = $this->option('output-file');
    $binary = $this->option('binary');

    $dbConfig = Config::get('database.connections.pgsql');

    $format = ($binary == 'false') ? '--schema-only' : '-Fc';
    $dumpSchemaCommand = "pg_dump {$format} {$dbConfig['database']} -U {$dbConfig['username']} -h {$dbConfig['host']} > {$dumpFile}";

    if(file_exists($dumpFile)) {
      shell_exec("rm {$dumpFile}");
    }

    $this->info($dumpSchemaCommand);
    shell_exec($dumpSchemaCommand);
  }

}
