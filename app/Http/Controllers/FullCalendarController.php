<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
class FullCalendarController extends Controller
{
    public function createEvent(Request $request)
    {
		$data = array(
            "title" => $request->title,
            "start" => $request->start,
            "end" => $request->end,
		    "gmt_start" => $request->gmt_start,
			"gmt_end" => $request->gmt_end,
            "color" => $request->color
        );
		$events = \DB::table('events')->insert($data);
		return response()->json($events);
    }

    public function deleteEvent(Request $request){
       return  \DB::table('events')->where('gmt_start',$request->start)->delete();
    }
}
