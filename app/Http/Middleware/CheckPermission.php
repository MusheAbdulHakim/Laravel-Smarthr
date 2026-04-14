<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (! $request->user()) {
            abort(401, __('Unauthorized'));
        }

        $permissions = explode('|', $permission);

        if (! $request->user()->hasAnyPermission($permissions)) {
            abort(403, __('You do not have permission to access this resource.'));
        }

        return $next($request);
    }
}
