<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonateController extends Controller
{
    public function index()
    { 
        $categories = Category::whereIsActive('y')->get();
        $donations = Donation::whereIsActive('y')->where('status','approved')->get();
        return view('frontend.pages.donate.index',compact(['categories','donations'])); 
    }
    public function store(Request $request){
        $request['custom_id'] = getUniqueString('donations');
        $donation = Donation::create($request->all());
        if ($request->has('donar_image')) {
            $path = $request->file('donar_image')->store('donars');
        }
        $donation->donar_image = $path;
        if ($donation->save()) {
            flash('Donation Add successfully!')->success();
        } else {
            flash('Unable to save avatar. Please try again later.')->error();
        }
        return redirect()->route('donates.index');
    }
}
