<?php

// Permission for admin panel

use Illuminate\Support\Facades\Auth;

function getPermissions($user_type = 'normal')
{
    $permissions = array();

    if ($user_type == 'admin') {
        $permissions = [
            1 =>[ // Dashboard
                'permissions' => 'access'
            ],
            2 =>[ //Role Management
                'permissions' => 'access,add,edit,delete'
            ],
            3 =>[ // Users
                'permissions' => 'access,add,edit,delete,view'
            ],
            4 => [ // gallery
                'permissions' => 'access,add,edit,delete'
            ],
            5 => [ // FAQ 
                'permissions' => 'access,add,edit,delete,view'
            ],
            6 => [ // cms
                'permissions' => 'access,add,edit,delete'
            ],
            7 => [ // countries
                'permissions' => 'access,add,edit,delete'
            ],
            8 => [ // state
                'permissions' => 'access,add,edit,delete'
            ],
            9 => [ // cities
                'permissions' => 'access,add,edit,delete'
            ],
            10 => [ // addresses
                'permissions' => 'access,add,edit,delete'
            ],
            11 => [ // categories
                'permissions' => 'access,add,edit,delete'
            ],
            12 => [ // events
                'permissions' => 'access,add,edit,delete'
            ],
            13 => [ // donation
                'permissions' => 'access,add,edit,delete'
            ],
            14 => [ // volunteer
                'permissions' => 'access,add,edit,delete'
            ],
        ];
    }

    return $permissions;
}

// Call CURL
function fireCURL($url, $type, $data = NULL)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => strtoupper($type),
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array("Content-Type:application/json"),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return (object) json_decode($response, true);
}

// Show number is cool format, like 1K, 2M, 50K etc
function number_format_short($n, $precision = 1)
{
    if ($n < 900) {
        $n_format = number_format($n, $precision);
        $suffix = '';
    } else if ($n < 900000) {
        $n_format = number_format($n / 1000, $precision);
        $suffix = 'K';
    } else if ($n < 900000000) {
        $n_format = number_format($n / 1000000, $precision);
        $suffix = 'M';
    } else if ($n < 900000000000) {
        $n_format = number_format($n / 1000000000, $precision);
        $suffix = 'B';
    } else {
        $n_format = number_format($n / 1000000000000, $precision);
        $suffix = 'T';
    }
    if ($precision > 0) {
        $dotzero = '.' . str_repeat('0', $precision);
        $n_format = str_replace($dotzero, '', $n_format);
    }
    return $n_format . $suffix;
}

function getUniqueString($table, $length = NULL){
    $length = $length ?? config('utility.custom_length', 8);
    $field = 'custom_id';

    $string = \Illuminate\Support\Str::random($length);
    $found = \Illuminate\Support\Facades\DB::table($table)->where([$field => $string])->first();
    if ($found) {
        return getUniqueString($table, $field, $length);
    } else {
        return $string;
    }
}

function getUniqueDigitsCode($table, $type = NULL, $length = NULL){
    
    $string = rand(000001,999999);
    $found = \Illuminate\Support\Facades\DB::table($table)->where([$type => $string])->first();
    if ($found) {
        return getUniqueString($table, $type, $length);
    } else {
        return $string;
    }
}

function generateURL($file = "")
{
    // dd($file);
    return App\Http\Controllers\Admin\HelperController::generateUrl($file);
}
function get_guard()
{
    //You Need to define all guard created
    if (Auth::guard('admin')->check()) {
        return "admin";
    } elseif (Auth::guard('web')->check()) {
        return "user";
    } else {
        return "Guard not match";
    }
}
