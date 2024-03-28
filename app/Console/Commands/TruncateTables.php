<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TruncateTables extends Command
{
    protected $signature = 'db:truncate';

    protected $description = 'Truncate all tables';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        $this->info('All tables truncated');
    }
}
