<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::join('roles','users.role_id','=','roles.id')->select(['users.*','roles.name as roleName'])->findOrFail(session('user_id'));
        if ($user->roleName != 'admin'){
            return redirect()->route('loginForm')->with('error','You are not authorized to access this page');
        }
        return $next($request);
    }
}
