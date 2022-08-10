<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApiLanguage
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
        $default_lang_code = config('utility.default_lang_code');
        $language_allowed  = ['en', 'fr'];
        $language = request()->header()['x-language'][0] ?? $default_lang_code;
        $language = in_array($language, $language_allowed) ? $language : $default_lang_code;
        app()->setLocale($language);
        return $next($request);
    }
}
