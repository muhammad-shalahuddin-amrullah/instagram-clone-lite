<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUsername
{

    public function handle(Request $request, Closure $next)
    {
        $username = $request->route('username');
        if ($username !== auth()->user()->username) {
            abort(403);
        }
        return $next($request);
    }
}
