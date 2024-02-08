<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if(Auth::user()->isAdmin()) {
                return $next($request);
            }
        }

        $contains = Str::contains(request()->path(), 'api');

        if($contains){
            return response()->json([
                'status' => 200,
                'statusMessage' => 'success',
                'message' => 'You don\'t have admin access.',
            ]);
        }

        return redirect('home');
    }
}
