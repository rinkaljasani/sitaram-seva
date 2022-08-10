<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use App\Models\Donation;
use App\Models\Event;
use App\Models\Gallery;
use Illuminate\Http\Request;

class FrontendPagesController extends Controller
{

    public function index()
    { 
        $donations = Donation::where('status', 'approved')->latest()->take(4)->get();
        $benifical = Event::sum('benifical');
        $events = Event::latest()->take(5)->get();
        return view('frontend.pages.index',compact(['donations','benifical','events'])); 
    }
    public function howItsWork(){ return view('frontend.pages.how-it-works'); }
    public function imageGallery(){ 
        $galleries = Gallery::where('type','image')->get();
        return view('frontend.pages.gallery',compact('galleries')); }
    public function videoGallery(){ 
        $galleries = Gallery::where('type','video')->get();
        return view('frontend.pages.gallery',compact('galleries')); }
    public function about(){ 
        $categories = Category::whereIsActive('y')->get();
        return view('frontend.pages.about',compact('categories')); }
    public function contact(){ 
        $addresses = Address::get();
        return view('frontend.pages.contact',compact('addresses')); }
    public function blog(){ return view('frontend.pages.blog'); }
    public function category()
    { 
        $categories = Category::whereIsActive('y')->get();
        return view('frontend.pages.category',compact('categories'));
    }
}
