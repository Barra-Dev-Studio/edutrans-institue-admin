<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CallbackMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->isMethod("POST")) {
            return response([], 400);
        }

        if (!$request->hasHeader("x-callback-token")) {
            return response([], 401);
        }

        if ($request->header('x-callback-token') != env('XENDIT_CALLBACK_TOKEN')) {
            return response([], 401);
        }

        return $next($request);
    }
}
