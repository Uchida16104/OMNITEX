<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Paths
    |--------------------------------------------------------------------------
    |
    | Here you may specify which view paths should be checked for your views.
    | Laravel will search in these directories for your Blade templates.
    |
    */

    'paths' => [
        resource_path('views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all compiled Blade templates are stored.
    | The fallback keeps the path valid even if realpath() returns false.
    |
    */

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views')) ?: storage_path('framework/views')
    ),

    /*
    |--------------------------------------------------------------------------
    | Relative Hash
    |--------------------------------------------------------------------------
    |
    | When enabled, compiled views use a path relative to the application base.
    |
    */

    'relative_hash' => env('VIEW_RELATIVE_HASH', false),

    /*
    |--------------------------------------------------------------------------
    | View Cache
    |--------------------------------------------------------------------------
    |
    | This controls whether Blade compilation is cached.
    |
    */

    'cache' => env('VIEW_CACHE', true),

    /*
    |--------------------------------------------------------------------------
    | Compiled Extension
    |--------------------------------------------------------------------------
    |
    | This is the extension used for compiled Blade files.
    |
    */

    'compiled_extension' => env('VIEW_COMPILED_EXTENSION', 'php'),
];
