<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reserve;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



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
        // $reserve=Reserve::where('is_reserve',1)->get();

        // $reserve = Reserve::all();

        // foreach($reserve as $res)
        // {
        //     $eDate = $res->created_at->addDays(1);

        //     // $res->update(['is_reserve'=>0]);

        //     if($eDate>=Carbon::now())
        //     {
        //         // $re=Reserve::where('created_at',$res->created_at)->delete();
        //         //  DB::update('update reserves set is_reserve = ? where created_at = ?',['0',$res->created_at]);
        //         // DB::update('update reserves set is_reserve = ? ',['0']);
        //         DB::table('reserves')->where('created_at',$res->created_at)->delete();
        //     }
        // }
        // \Log::info('lina');
    }
}
