<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VolunteerRequest;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(){
        $teams = Volunteer::where('status','approved')->get();
        return view('frontend.pages.team.index',compact(['teams'])); 
    }
    public function store(VolunteerRequest $request){
        $request['custom_id'] = getUniqueString('volunteers');
        $volunteer = Volunteer::create($request->all());
        if ($request->has('profile_photo')) {
            $path = $request->file('profile_photo')->store('volunteer');
        }
        $volunteer->image = $path;
        $volunteer->save();
        return redirect()->route('team.index');
    
    }
}
