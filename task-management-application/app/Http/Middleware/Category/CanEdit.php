<?php

namespace App\Http\Middleware\Category;

use App\Models\Category;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanEdit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
     
        $category_id = $request->route("category")->id;
        $category = Category::where('id', $category_id)->first();
 
        if (!$category || $category->user_id !== auth()->user()->id) {
            abort(403);
        }
        return $next($request);
    }
}
