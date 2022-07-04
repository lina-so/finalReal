<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reserve;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Realestate;

class Reservation extends Command
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
        $reals=Reserve::select('user_id','real_id')->whereDate('created_at', '<', Carbon::now()->subDays(1))->
        get();

        // dd($reals);

        foreach($reals as $real)
        {
        //     $get=Realestate::select('status')->where('id', '=', $real->real_id)->where('user_id', '=', $real->user_id)
        //     ->get();

        // \Log::info($get);
    

            $pend='failed';
    
            $update=Realestate::where('id', '=', $real->real_id)->where('user_id', '=', $real->user_id)
            ->update(['status' => $pend]);
   
        }

        $reserve=Reserve::whereDate('created_at', '<', Carbon::now()->subDays(1))->
        delete();

        // \Log::info($reals);
    }
}
