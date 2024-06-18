<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\HomeServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function __construct(private HomeServiceInterface $repo)
    {

    }

    public function home()
    {
        $data = [];
        $data['latest_products'] = $this->repo->getLatestProductList();
        return view('frontend.home.homepage', $data);
    }
}
