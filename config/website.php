<?php

return [
    "slogan" => "Welcome to Ecom Mart BD! Your trusted one-stop destination for all needs!",
    "address" => "Bismillah Store, Ward No:5, House No: 2644/1, Kutubpur Union Porishod, West Shahid Nagar, Matuail, Dhaka",
    "email" => "support@ecommartbd.com",
    "mobile" => "+880 1407-325822",
    "user" => [
        "division" => [
            "Dhaka",
            "Chattogram",
            "Rajshahi",
            "Sylhet",
            "Khulna",
            "Mymensingh",
            "Rangpur",
            "Barishal",
        ]
    ],
    "order_from" => [
        "website",
        "facebook",
        "messanger",
        "instagram",
        "linkedin",
        "call",
    ],
    "courier" => [
        "pathao",
        "steadfast",
        "redex",
        "sundarban",
        "sa paribahan",
        "by office",
    ],
    "api" => [
        "news" => [
            "endpoint" => env('NEWS_API_ENDPOINT', "test.com"),
            "api_key" => env('NEWS_API_KEY', "112234"),
        ]
    ]
];
