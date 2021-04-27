<?php

namespace App\Http\Middleware;

use App\Traits\AdminTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->role == AdminTrait::$ADMIN_ROLE)
            return $next($request);
        else
            abort(Response::HTTP_FORBIDDEN);
    }
}
