<?php

namespace App\Http\Middleware;

use App\Services\TrafficCacheService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;
use Symfony\Component\HttpFoundation\Response;

class TrackTrafficMiddelware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $data = [];
        $agent = new Agent();
        $data["browser"] = $agent->browser();
        $data["version"] = $agent->version($agent->browser());
        $data["device"] = $agent->device();
        $data["platform"] = $agent->platform();
        $data["languages"] = $agent->languages();
        $data["isDesktop"] = $agent->isDesktop();        ;
        $data["isIos"] = $agent->is('iPhone');
        $data["isAndroid"] = $agent->isAndroidOS();
        $data["isRobot"] = $agent->robot();
        $data["ip"] = $request->ip();
        $data["location"] = false;
        // Get user location based on IP address
        if(env("APP_ENV") == "production") {
            $data["location"] = Location::get($data["ip"]);
        }
        TrafficCacheService::store($data, $request->route()->uri());
        return $next($request);
    }
}
