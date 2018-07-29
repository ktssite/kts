<?php

namespace KTS\Http\Middleware;

use Closure;

class HttpsProtocol {

    public function handle($request, Closure $next)
    {
        if (config('app.env') == 'production') {
            $request->server->set('HTTPS', true);
        }

            return $next($request); 
    }
}