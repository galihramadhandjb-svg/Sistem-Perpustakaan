<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureBorrower
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user->hasRole(['admin', 'petugas'])) {
            return redirect('/dashboard');
        }

        abort_unless($user->hasRole('peminjam'), 403);

        return $next($request);
    }
}
