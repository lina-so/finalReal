<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Reserve extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:reserve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'user reservation  expire every 4 days';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
