<?php

namespace App\Http\Controllers;

use App\Http\Requests\Note\StoreNoteRequest;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Requests\Task\UpdateTaskStatusRequest;
use App\Models\Note;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function getTask($uuid)
    {
        $task_model = new Task();
        $task = $task_model->getTask($uuid);
        return $task;
    }

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
    public function edit(string $uuid)
    {
        $task = $this->getTask($uuid);
        if (!$task) {
            return redirect()->back()->with('error', 'No Task Found');
        }
        return view('tasks.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $uuid)
    {
        $validated_request = $request->validated();
        $task = $this->getTask($uuid);
        if (!$task) {
            abort(404);
        }
        $task->update($validated_request);
        return redirect()->route('tasks.show', $uuid)->with('success', 'Task Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Update Task Status and Priority
     * @param \App\Http\Requests\Task\UpdateTaskStatusRequest $request
     * @param string $uuid
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Adding Notes to a task
     * @param \App\Http\Requests\Note\StoreNoteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store_note(StoreNoteRequest $request)
    {
        $request_validated = $request->validated();
        Note::create($request_validated);
        return redirect()->back()->with('success', 'Note Added');
    }
}
