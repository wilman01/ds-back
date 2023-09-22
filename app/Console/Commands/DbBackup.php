<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Spatie\DbDumper\Databases\MySql;

class DbBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create database backup';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = "ds-backup_" . strtotime(now()) . ".sql";

        File::put($filename, '');
        MySql::create()
        ->setDbName(env('DB_DATABASE'))
        ->setUserName(env('DB_USERNAME'))
        ->setPassword(env('DB_PASSWORD'))
        ->setHost(env('DB_HOST'))
        ->setport(env('DB_PORT'))
        ->dumpToFile($filename);
    }
}
