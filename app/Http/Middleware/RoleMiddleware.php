<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $role = explode('|', $role);

        if (request()->wantsJson()){
            // For API request
            if (!auth('sanctum')->user())
            return response()->json([
                "message" => "يجب تسجيل دخولك"
            ], 401);

        if (!auth('sanctum')->user()->email_verified_at)
            return response()->json([
                "message" => "البريد الالكتروني لديك غير مفعل"
            ], 401);
        if(!auth('sanctum')->user()->hasRole($role))
            return response()->json([
                "message" => "ليس لديك صلاحية للوصول"
            ], 401);
        }else{
            // For web request
            if (
                !auth()->user() 
                || !auth()->user()->email_verified_at
                || !auth()->user()->hasRole($role)
                )  redirect()->back();
        }

        return $next($request);
    }
}