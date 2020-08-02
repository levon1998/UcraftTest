<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfUserHasNotWallet
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
        if ($request->user()->wallets->isEmpty()) {
            return redirect('/create-wallet');
        }
        return $next($request);
    }
}
