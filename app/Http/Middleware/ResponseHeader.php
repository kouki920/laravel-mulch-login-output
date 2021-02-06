<?php

namespace App\Http\Middleware;

use Closure;

class ResponseHeader
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
        $response = $next($request);

        /**
         * キャッシュコントロール対策
         * ※デフォルトは「no-cache, private」だが、明示的に記載
         */
        $response->header('Cache-Control', 'no-cache, private');

        /**
         * クリックジャッキング対策
         * ※iframeを使用させない
         */
        $response->header('X-Frame-Options', 'DENY');

        return $response;
    }
}
