<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClientMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->role !== 'client') {
            return response()->json(['message' => 'Access Denied.'], 403);
        }

        return $next($request);
    }
}
