<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DbFix extends Command {

  protected $signature = 'db:fix';
  protected $description = 'Drop, Create, Install Migrations, Migrate, Seed';

  public function handle() {
    $this->call('db:drop');
    $this->call('db:create');
    $this->call('migrate:install');
    $this->call('migrate');
    $this->call('db:seed');
  }

}
