<?php

namespace BMC_API\Http\Middleware;

use Closure;

class ExecuteBefore
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
        // if ($request) {
        //     redirect()->action('BMC_API\Http\Controllers\ProdutoController@find()');
        // }
        return $next($request);
    }
}

