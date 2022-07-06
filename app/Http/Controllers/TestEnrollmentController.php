<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Notifications\TestDesire;

// use App\Notification\TestDesire;
// use App\Notification\TestDesire;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class TestEnrollmentController extends Controller
{
    public function sendTestNotification()
    {
        $user=User::first();
        $enrollmentData=[
            'body'=>'you recived an new test notification',
            'enrollmentText'=>'you are allowed to enroll',
            'url'=>url('/'),
            'thankyou'=>'you have 14 days to enroll',
        ];

        $user->notify(new TestDesire($enrollmentData));
    }
}
