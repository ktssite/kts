<?php

namespace KTS\Http\Middleware;

use Closure;

class HttpsProtocol {

    public function handle($request, Closure $next)
    {
            if (config('app.env') == 'production') {
                return redirect()->secure($request->getRequestUri());
            }

            return $next($request); 
    }
}