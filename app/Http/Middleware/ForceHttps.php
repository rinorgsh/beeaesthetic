<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class ForceHttps
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->secure() && App::environment(['production'])) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}