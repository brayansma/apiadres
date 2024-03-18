<?php

namespace App\Http\Middleware;

use Closure;

class NotFoundHandlerMiddleware
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
        /* $response = $next($request);
        return $response; */
        $response = $next($request);

        // Si la respuesta es un error 404 (not found)
        if ($response->status() == 404) {
            // Retorna un mensaje personalizado
            return response()->json([
                'error' => 'Ruta no encontrada',
                'message' => 'La ruta solicitada no se encuentra: ' . $request->url(),
            ], 404);
        }

        return $response;
    }
}
