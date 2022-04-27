<?php

namespace App\Http\Controllers;
// use DateTime;
use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\Post;
use Illuminate\Http\Request;
use DB;
// use DataTime;
use Carbon\Carbon;


class PostController extends Controller
{
   
    public function allPosts()
    {
        $month_array=array();
        // $posts = DB::select('select * from posts');
        $posts_dates=Post::orderBy('created_at','ASC')->pluck('created_at');
        // $posts_dates=json_decode($posts_dates);   

       if(! empty($posts_dates))
       {
           foreach($posts_dates as $unformatted_date)
           {
                
        
            //    $date=new \DateTime($unformatted_date->date);
                  $monthName = $unformatted_date->format('F');
                  $month_number=$unformatted_date->format('m');
                  $month_array[$month_number]=$monthName;
        //          echo '<pre>';
        // print_r($month_array);
               

           }
       }
       return $month_array;
    }

    function getMonthlyPostCount($month)
    {
        //  $month=06;
         $monthly_post_count=Post::whereMonth('created_at',$month)->get()->count();
         return $monthly_post_count;
    }

    function getMonthlyPostData()
    {
        
        $monthly_post_count_array=array();
        $month_array=$this->allPosts();
        $month_name_array=array();
        // echo '<pre>';
        // print_r($month_array);
        // die();
        if(!empty($month_array))
        {
            foreach($month_array as $month_no => $month_name)
            {
                $monthly_post_count=$this->getMonthlyPostCount($month_no);
                array_push($monthly_post_count_array,$monthly_post_count);
                array_push($month_name_array,$month_name);
            }
        }
    //    $month_array=$this->allPosts();
    $max_no=max($monthly_post_count_array);
    $max=round(($max_no + 10/2)/10)*10;
       $monthly_post_data_array=array(
           'months' => $month_name_array,
           'post_count_data' => $monthly_post_count_array,
           'max'=>$max,

       );
       return $monthly_post_data_array;
    }
   
}
