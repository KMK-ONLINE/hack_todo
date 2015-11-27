<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Config;

class DbCreate extends Command {

  protected $signature =    "db:create";
  protected $description =  "Create the current environment's database";

  public function handle() {
    $dbConfig = Config::get('database.connections.pgsql');
    $createdbCommand = "createdb {$dbConfig['database']} -U {$dbConfig['username']} -h {$dbConfig['host']}";
    $this->info($createdbCommand);
    shell_exec($createdbCommand);
  }

}
