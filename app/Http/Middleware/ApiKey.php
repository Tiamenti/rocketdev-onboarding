<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-Key');

        if (! $apiKey) {
            abort(401, 'API key is required');
        }

        if ($apiKey !== config('app.api_key')) {
            abort(401, 'Invalid API key');
        }

        return $next($request);
    }
}
