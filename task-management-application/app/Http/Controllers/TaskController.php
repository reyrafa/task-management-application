<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateTaskStatusRequest;
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
                'title' => $task->title . ' - ' . $task->status,
                'extendedProps' => [
                    'status' => $task->status,
                    'task' => $task->uuid,
                    'priority' => $task->priority,
                ],
                'start' => $task->start_date,
                'end' => $task->due_date,
                'backgroundColor' => $task->priority === 'low' ? '#808080' : '#cc0000',
                'textColor' => $task->priority === 'low' ? '#f2f2f2' : '#ffe5e5',

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

    public function updateTaskStatus(UpdateTaskStatusRequest $request, string $uuid)
    {
        $task_model = new Task();
        $task = $task_model->getTask($uuid);
        if (!$task) {
            abort(404);
        }
        $task_status = $task->status;
        $task_priority = $task->priority;
        switch ($task->status) {
            case 'pending':
                $task_status = 'ongoing';
                break;
            case 'ongoing':
                $task_status = 'done';
                $task_priority = 'low';
                break;
            case 'done':
                $task->delete();
                return redirect()->route('tasks.index')->with('success', "Task is being archive");
            default:
                $task_status = $task->status;
        }
        $task->update([
            'status' => $task_status,
            'priority' => $task_priority,
        ]);
        return redirect()->back()->with('success', "Task is $task_status");

    }
}
