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
			"coordinates" => $request->coordinates,
			"view" => $request->view
        );
		$events = \DB::table('events')->insert($data);
		return response()->json($events);
    }

    /*public function deleteEvent(Request $request){
        $event = Event::find($request->id);
        return $event->delete();
    }*/
}
