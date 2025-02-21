<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\HttpStatus;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PermissionMiddleware
{
    public function handle(Request $request, Closure $next, $permissionsList, $guard = null): Response
    {
        $authGuard = app('auth')->guard($guard);

        if ($authGuard->guest()) {
//            throw UnauthorizedException::notLoggedIn();
        }

        $permissions = is_array($permissionsList) ? $permissionsList : explode('|', $permissionsList);
        foreach ($permissions as $permission) {
            if (in_array($permission, $authGuard->user()->getAllPermissions()->pluck('name')->toArray())) {
                return $next($request);
            }
        }

        throw new HttpException(HttpStatus::FORBIDDEN, 'User does not have right permissions');
    }
}
