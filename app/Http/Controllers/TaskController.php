<?php

namespace App\Http\Controllers;

use App\User;
use App\Task;
use App\Label;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
        $this->authorizeResource(Task::class, 'task');
    }

    public function index(Request $request)
    {
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->get();

        $creators = User::pluck('name', 'id');
        $assigners = User::pluck('name', 'id');
        $statuses = Status::pluck('name', 'id');

        return view('tasks.index', [
            'tasks' => $tasks,
            'creators' => $creators,
            'assigners' => $assigners,
            'statuses' => $statuses,
            'filteredStatus' => $request->input('filter.status_id'),
            'filteredCreator' => $request->input('filter.created_by_id'),
            'filteredAssigner' => $request->input('filter.assigned_to_id'),
        ]);
    }

    public function create()
    {
        $task = new Task();

        $assigners = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');
        $statuses = Status::pluck('name', 'id');

        return view('tasks.create', [
            'task' => $task,
            'labels' => $labels,
            'statuses' => $statuses,
            'assigners' => $assigners,
        ]);
    }

    public function store(Request $request)
    {
        $task = new Task();

        $data = $request->validate([
            'name' => 'required|max:50',
            'description' => 'nullable|max:500',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable',
            'label_id' => 'array',
            'label_id.*' => 'exists:labels,id',
        ]);

        $task->fill($data);
        $task->createdBy()->associate(Auth::user());
        $task->save();

        flash(__('tasks.store'))->success()->important();

        $labelId = Arr::get($data, 'label_id', []);
        $task->labels()->sync($labelId);

        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('tasks.show', ['task' => $task]);
    }

    public function edit(Task $task)
    {
        $assigners = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');
        $statuses = Status::pluck('name', 'id');

        return view('tasks.edit', [
            'task' => $task,
            'labels' => $labels,
            'statuses' => $statuses,
            'assigners' => $assigners,
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:500',
            'status_id' => 'nullable',
            'assigned_to_id' => 'nullable',
            'label_id' => 'array',
            'label_id.*' => 'exists:labels,id',
        ]);

        $task->fill($data);
        $task->save();

        flash(__('tasks.update'))->important();

        $labelId = Arr::get($data, 'label_id', []);
        $task->labels()->sync($labelId);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->labels()->detach();
        $task->delete();

        flash(__('tasks.destroy'))->error()->important();

        return redirect()->route('tasks.index');
    }
}
