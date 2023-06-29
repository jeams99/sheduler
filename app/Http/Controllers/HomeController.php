<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $events = Event::all();
        $data = [];
        foreach($events as $value) {
            $data[] = [
                "title"=>$value->title,
                "start"=>$value->start,
                "end"=>$value->end,
                "color"=>$value->color
            ];
        }
        return view('home',['events'=>$data]);
      }

}
