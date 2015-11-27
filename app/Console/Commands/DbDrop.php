<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Config;

class DbDrop extends Command {

  protected $signature =    "db:drop";
  protected $description =  "Drop the current environment's database";

  public function handle() {
    $dbConfig = Config::get('database.connections.pgsql');
    $dropdbCommand = "dropdb {$dbConfig['database']} -U {$dbConfig['username']} -h {$dbConfig['host']}";
    $this->info($dropdbCommand);
    shell_exec($dropdbCommand);
  }
}
