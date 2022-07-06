<?php


namespace App\Http\Controllers;
use App\Mail\AttachmentMail;
use Illuminate\Support\Facades\Mail;


use Illuminate\Http\Request;

class EmailsController extends Controller
{
    public function email()
    {
        Mail::to('LinaSoleman63@gmail.com')->send( new AttachmentMail());
        // return new AttachmentMail();
    }
}
