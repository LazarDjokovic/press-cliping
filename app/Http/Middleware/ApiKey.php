<?php
/**
 * Created by PhpStorm.
 * User: mgk
 * Date: 9.10.18.
 * Time: 08.59
 */

namespace App\Http\Middleware;
use Closure;


class ApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->api_key)
            return response('api_key not defined. Method not allowed.', 405);

        return $next($request);
    }
}
