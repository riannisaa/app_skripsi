<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Exception;

class CheckDatabaseConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:check-connection';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the database connection';
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::connection()->getPdo();
            $this->info('Database connection is successful.');
        } catch (Exception $e) {
            $this->error('Could not connect to the database. Please check your configuration. Error: ' . $e->getMessage());
        }
    }
}
