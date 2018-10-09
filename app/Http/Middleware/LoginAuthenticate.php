<?php
/**
 * Created by PhpStorm.
 * User: mgk
 * Date: 9.10.18.
 * Time: 09.00
 */

namespace App\Http\Middleware;
use Closure;

class LoginAuthenticate
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
        if(!Auth::check())
            return response(array('success'=>false,'error'=>'User nije logovan'));

        return $next($request);
    }
}
