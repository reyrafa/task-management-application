<?php

namespace App\Http\Middleware\Task;

use App\Models\Task;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanEditTask
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $task_model = new Task();
        $task = $task_model->getTask($request->route()->parameter('task'));
        if (!$task || $task->user_id !== auth()->user()->id) {
            abort(403);
        }
        return $next($request);
    }
}
