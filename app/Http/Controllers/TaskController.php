<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Task;
use App\Label;
use App\Status;
use App\Http\Request\TaskRequest;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
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

        return view('task.index', [
            'tasks' => $tasks,
            'creators' => $creators,
            'assigners' => $assigners,
            'statuses' => $statuses,
        ]);
    }

    public function create()
    {
        $task = new Task();

        $assigners = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');
        $statuses = Status::pluck('name', 'id');

        return view('task.create', [
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
            'description' => 'required|max:500',
            'status_id' => 'nullable',
            'assigned_to_id' => 'nullable',
            'label_id' => 'array',
            'label_id.*' => 'exists:labels,id',
        ]);

        $task->fill($data);

        $task->createdBy()->associate(Auth::user());

        if (!$task->save()) {
            flash(__('task.savingFailed'))->success()->important();
        } else {
            flash(__('task.store'))->success()->important();
        }

        $task->labels()->sync(Arr::get($data, 'label_id', []));

        return redirect()->route('task.index');
    }

    public function edit(Task $task)
    {
        if (Auth::user()->id !== $task->createdBy->id) {
            flash(__('task.preventEdited'))->error()->important();

            return redirect()->route('task.index');
        }

        $assigners = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');
        $statuses = Status::pluck('name', 'id');

        return view('task.edit', [
            'task' => $task,
            'labels' => $labels,
            'statuses' => $statuses,
            'assigners' => $assigners,
        ]);
    }

    public function update(Request $request, Task $task)
    {
        if (Auth::user()->id !== $task->createdBy->id) {
            flash(__('task.preventEdited'))->error()->important();

            return redirect()->route('task.index');
        }

        $data = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:500',
            'status_id' => 'nullable',
            'assigned_to_id' => 'nullable',
            'label_id' => 'array',
            'label_id.*' => 'exists:labels,id',
        ]);

        $task->fill($data);

        if (!$task->save()) {
            flash(__('task.editingFailed'))->error()->important();
        } else {
            flash(__('task.update'))->important();
        }

        $task->labels()->sync(Arr::get($data, 'label_id', []));

        return redirect()->route('task.index');
    }

    public function destroy(Task $task)
    {
        if (Auth::user()->id !== $task->createdBy->id) {
            flash(__('task.preventDeleted'))->error()->important();

            return redirect()->route('task.index');
        }

        $task->labels()->detach();

        if (!$task->delete()) {
            flash(__('task.deletingFailed'))->error()->important();
        } else {
            flash(__('task.destroy'))->error()->important();
        }

        return redirect()->route('task.index');
    }
}
