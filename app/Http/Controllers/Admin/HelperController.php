<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HelperController extends Controller
{
    public static function generateUrl($path)
    {   
        $url = "";
        if( !empty($path) ){
            $path = ltrim($path, '/');
        }
            

        if( !empty($path) && Storage::exists($path) ){
            $url = Storage::url($path);
        }
            
        // $url = Storage::temporaryUrl( $path, now()->addMinutes(5) );
        // $url = 'http://127.0.0.1:8000/storage/'.$path;
    
        return $url;
    }
}
