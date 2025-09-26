<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     *
     *
     * @param  \Closure  $next
     *
     *
     *
     * @param  string|null  $guard
     *
     * @return mixed
     */

     public function handle($request, Closure $next)
     {
         // Skip CORS for export routes
         if (strpos($request->route()->getName(), 'export') !== false) {
             return $next($request);
         }
     
         $response = $next($request); // Capture the response first
     
         // Safely set headers (no chaining!)
         $response->headers->set('Access-Control-Allow-Origin', '*');
         $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
     
         return $response;
     }
     
}
