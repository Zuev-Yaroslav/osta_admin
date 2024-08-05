<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ChangeLanguage
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
        $lang = $request->header('X-Localization');
        if(isset($lang)){
            if(!in_array($lang, ['ru', 'tt'])){
                return response()->json(['message' => 'Language is not found'], 404);
            }
        }
        else {
            return response()->json(['message' => 'Language not specified'], 404);
        }
        app()->setLocale('tt');
        if($lang === "ru") {
            app()->setLocale($lang);
        }
        return $next($request);
    }
}
