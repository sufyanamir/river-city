<?php

namespace App\Http\Middleware;

use App\Models\ThirdPartyClient;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $key = $request->header('X-API-KEY');

        if (!$key) {
            return response()->json(['success' => false, 'message' => 'API key missing'], 401);
        }

        $client = ThirdPartyClient::where('api_key', $key)->first();

        if (!$client) {
            return response()->json(['success' => false, 'message' => 'Invalid API key'], 401);
        }

        // Fetch the actual user using the client_id
        $user = User::where('id', $client->client_id)->first();

        if (!$user) {
            return response()->json(['success' => false, 'error' => 'Associated user not found'], 404);
        }

        // Bind the user to the request
        auth()->setUser($user); // instead of $request->merge()

        return $next($request);


    }
}
