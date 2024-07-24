<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
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
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),

    'status' => [
        'active' => "success",
        'deactive' => "danger",
        'rejected' => "danger",
        'declined' => "danger",
        'pending' => "warning",
        'freeze' => "warning",
        'paused' => "warning",
        'assigned for delivery' => "success",
        'out for delivery' => "success",
        'returned' => "danger",
        'cancelled' => "danger",
        'with hold' => "warning",
        'delivered' => "success",
        'out of stock' => "secondary",
        'waiting' => "warning",
    ]

];
