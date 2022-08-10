<?php

return [
    'caching'               =>  env('CACHE_ALLOW', false),
    'custom_length'         =>  env('CUSTOM_ID_LENGTH', 20),
    'password_length'       =>  env('PASSWORD_DEFAULT_LENGTH', 10),
    'default_password'      =>  env('DEFAULT_PASSWORD','clientdealer123'),
    'token'                 =>  env('TOKEN_NAME', 'laravel'),
    'default_lang_code'     =>  env('DEFAULT_LANG_CODE', 'en'),
    'pagination'            =>  [
        'limit'         =>  env('DEFAULT_PAGINATION_LIMIT', 10),
        'offset'        =>  env('DEFAULT_PAGINATION_OFFSET', 0),
    ],
];
