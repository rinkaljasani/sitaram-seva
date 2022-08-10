<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        $events = Event::whereIsActive('y')->paginate(6);
        return view('frontend.pages.events.index',compact('events'));    
    }

    public function show(Event $event){
        return view('frontend.pages.events.view', compact('event'));
    }
}
