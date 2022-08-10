<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    { 
        $categories = Category::whereIsActive('y')->get();
        return view('frontend.pages.category.index',compact('categories'));
    }

    public function show(Category $category){
        $upcomings = Event::whereDate('event_at','>',Carbon::now())->paginate(6);
        $pasts = Event::whereDate('event_at','<',Carbon::now())->paginate(6);
        $currents = Event::whereDate('event_at',Carbon::today())->paginate(6);
        return view('frontend.pages.category.view', compact('category','upcomings','pasts','currents'));
    }
}
