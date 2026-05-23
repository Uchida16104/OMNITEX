<?php

return [
    /*
    |--------------------------------------------------------------------------
    | View Paths
    |--------------------------------------------------------------------------
    |
    | Here you may specify a list of paths that should be checked for your
    | views. By default, Laravel checks the resources/views directory.
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
    | This is where all compiled Blade templates will be stored.
    | The directory must exist and be writable.
    |
    */

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        storage_path('framework/views')
    ),

    /*
    |--------------------------------------------------------------------------
    | Relative Hashing
    |--------------------------------------------------------------------------
    |
    | When enabled, compiled view filenames are generated using a hash based
    | on the absolute path to the view file.
    |
    */

    'relative_hash' => env('VIEW_RELATIVE_HASH', false),

    /*
    |--------------------------------------------------------------------------
    | View Cache
    |--------------------------------------------------------------------------
    |
    | Determines whether Blade compiled views should be cached.
    |
    */

    'cache' => env('VIEW_CACHE', true),

    /*
    |--------------------------------------------------------------------------
    | Compiled Extension
    |--------------------------------------------------------------------------
    |
    | The file extension used for compiled Blade views.
    |
    */

    'compiled_extension' => 'php',
];
