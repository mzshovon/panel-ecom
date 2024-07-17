<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\HomeServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function __construct(private HomeServiceInterface $repo){}

    public function home()
    {
        $data = [];
        $data['latest_products'] = $this->repo->getLatestProductList();
        $data['upcoming_products'] = $this->repo->getUpcomingProducts();
        return view('frontend.home.homepage', $data);
    }

    public function about()
    {
        $data = [];
        return view('frontend.home.about', $data);
    }

    public function contactUs()
    {
        $data = [];
        return view('frontend.contact.view', $data);
    }

    public function storeContactUs(Request $request)
    {
        try{
            $data = $this->repo->storeContactUs($request->all());

            if($data) {
                return redirect()->back()->with("success", "Your message has been sent successfully!");
            } else {
                return redirect()->back()->with("error", "Something went wrong while sending message!");
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
    }

}
