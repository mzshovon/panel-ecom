<?php

return [
    "service-to-interface" => [
        'App\\Contracts\\Admin\\UserServiceInterface' => 'App\\Services\\Admin\\UserService',
        'App\\Contracts\\Admin\\ProductServiceInterface' => 'App\\Services\\Admin\\ProductService',
        'App\\Contracts\\HomeServiceInterface' => 'App\\Services\\HomeService',
        'App\\Contracts\\ProductServiceInterface' => 'App\\Services\\ProductService',
        'App\\Contracts\\CartServiceInterface' => 'App\\Services\\CartService',
    ]
];
