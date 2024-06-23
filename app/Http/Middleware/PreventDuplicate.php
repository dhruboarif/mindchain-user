<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PreventDuplicate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $cacheKey = 'user:' . $request->user()->id . ':recent-payment'; 
        $cacheValue = 'payment:' . $request->get('receiver_id') . ':' . $request->get('amount');
        if(Cache::get($cacheKey) == $cacheValue){
        return back()->with('error', 'Duplicate Payment!')->withInput(); 
        }
        $response = $next($request); 
        Cache::put($cacheKey, $cacheValue, 60); 
        return $response;
        
        //return $next($request);
    }
}
