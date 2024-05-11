<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
class EventController extends Controller
{
    //

    public function listEvent (Request $request)
    {
        return view('pages.event.index');
    }
}
