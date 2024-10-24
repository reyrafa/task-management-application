<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = [];
        $tasks = auth()->user()->tasks()->simplePaginate(5);

        foreach ($tasks as $task) {
            $events[] = [
                'title' => $task->title,
                'extendedProps' => [
                    'status' => $task->status,
                    'task' => $task->uuid,
                ],
                'start' => $task->start_date,
                'end' => $task->due_date,
                'backgroundColor' => '#0000cc',
                'borderColor' => 'transparent',
                'padding' => '50px',

            ];
        }
        return view('tasks.index', ['tasks' => $tasks, 'events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated_request = $request->validated();
        Task::create($validated_request);
        return redirect()->route('tasks.index')->with('success', 'Task was made successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $task = Task::where('uuid', $uuid)->first();
        return view('tasks.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
