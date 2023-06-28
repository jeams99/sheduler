<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class MainController extends Controller
{
        public function index() {

        $events = Event::all();
        foreach($events as $value) {
            $events[] = [

            ];
        }
        return view('welcome',['events'=>$events]);
    }
}
