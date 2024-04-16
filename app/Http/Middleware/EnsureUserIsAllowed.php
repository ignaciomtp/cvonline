<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Resume;

class EnsureUserIsAllowed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, String $id): Response
    {
        $cv = Resume::findOrFail($id);

        if(auth()->user()->id != $cv->user_id) {
            abort(403);
        }

        return $next($request);
    }
}
