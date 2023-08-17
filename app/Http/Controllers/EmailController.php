<?php

namespace App\Http\Controllers;

use App\Mail\NotifProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //
    public function index () 
    {
        Mail::to('afdhalluthfi145@gmail.com')->send(new NotifProduct());
        return 'Email telah dikirim';
    }
}
