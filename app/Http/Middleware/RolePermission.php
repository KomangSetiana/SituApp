<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class RolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        try {
            // Ambil user dari token JWT
            $user = JWTAuth::parseToken()->authenticate();
            // dd($user->role);
            // Ubah string roles menjadi array jika ada banyak roles
            $roles = explode(',', $roles);

            // Periksa apakah user memiliki salah satu role
            if (!in_array($user->role, $roles)) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'Token not found or invalid'], 401);
        }
        if (in_array($user->role, $roles)) {
            return $next($request);
        }
    }
}
