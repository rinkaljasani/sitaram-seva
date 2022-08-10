<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Dealer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UtilityController extends Controller
{
    // public function updateProfilePicture(Request $request)
    // {
    //     $user = Auth::user();

    //     if ($user->profile) {
    //         Storage::delete($user->profile);
    //     }
    //     $path = $request->file('profile_pic')->store('profiles');
    //     $user->profile = $path;

    //     if ($user->save()) {
    //         flash('Profile picture updated successfully!')->success();
    //     } else {
    //         flash('Unable to update profile picture. Try again later')->error();
    //     }

    //     return redirect()->back();
    // }

    // Common For All
    public function checkOldPassword(Request $request)
    {
        if (Hash::check($request->old_password, Auth::user()->password)) {
            return 'true';
        } else {
            return 'false';
        }
    }

    // For Unique email check of user & admin
    public function checkEmail(Request $request)
    {
        $id = $request->id ?? 0;
    	if( $request->type == 'user' ) {
    		$user = User::query();
    	} elseif($request->type == 'admin') {
    		$user = Admin::query();
    	}elseif($request->type == 'dealer'){
            $user = Dealer::query();
        }

    	$user =	$user->where([
    			['id', '<>', $id],
    			'email' => $request->email,
    		])->count();

    	if( $user == 0 ){
    	    return "true";
    	}else{
    	    return "false";
    	}
    }
    public function checkContact(Request $request)
    {
        $id = $request->id ?? 0;
    	if( $request->type == 'user' ) {
    		$user = User::query();
    	} elseif($request->type == 'admin') {
    		$user = Admin::query();
    	}

    	$user =	$user->where([
    			['id', '<>', $id],
    			'contact_no' => $request->contact_no,
    		])->count();

    	if( $user == 0 ){
    	    return "true";
    	}else{
    	    return "false";
    	}
    }

    public function noScript()
    {
        return view('errors.no-script');
    }

    public function noCookie()
    {
        return view('errors.no-cookie');
    }

    public function home()
    {
        return view('welcome');
    }

    public function adminHome()
    {
        $users = [];
        $users[] = Auth::user();
        $users[] = Auth::guard()->user();
        $users[] = Auth::guard('admin')->user();

        return redirect(route('admin.dashboard.index'));
    }

        // For Admin Panel Usage
    // public function checkTitle(Request $request)
    // {
    //     $id = $request->id ?? 0;
    //     if( $request->type == 'cms' ) {
    //         $data = CmsPage::query();
    //     }

    //     $data = $data->where([
    //             ['id', '<>', $id],
    //             'title' => $request->title,
    //         ])->count();


    //     if( $data == 0 ){
    //         return "true";
    //     }else{
    //         return "false";
    //     }
    // }

    public function profileCheckPassword(Request $request) {
        if(Hash::check($request->current_password, Auth::user()->password)){
            return "true";
        }else{
            return "false";
        }
    }

    
}

