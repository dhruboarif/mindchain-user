<?php



namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IpFilterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
     public function handle($request, Closure $next)
    {
        // Define the allowed IP address
        $allowedIps = ['103.69.148.164', '103.111.225.195','114.130.37.102','43.246.200.53','202.86.217.0','103.111.225.194','114.130.186.62','202.86.216.192'];

        // Check if the request comes from the allowed IP
         if (!in_array($request->ip(), $allowedIps)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}



