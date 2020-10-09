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
        $this->middleware('confirmation')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id')->ignore('all_statuses'),
                AllowedFilter::exact('created_by_id')->ignore('all_creators'),
                AllowedFilter::exact('assigned_to_id')->ignore('all_assigners'),
            ])
            ->get();
        $request = $request->post('filter');
        $filters = Task::all();
        return view('task.index', [
            'tasks' => $tasks,
            'filters' => $filters,
            'request' => $request
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::all();
        $statuses = Status::all();
        $labels = Label::all();
        return view('task.create', [
            'statuses' => $statuses,
            'users' => $users,
            'labels' => $labels
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $task = new Task();
        $data = $request->validate([
            'name' => 'required|max:50',
            'description' => 'max:500',
            'status_id' => 'required|exists:statuses,id',
            'assigned_to_id' => 'required|exists:users,id',
            'label_id' => 'array',
            'label_id.*' => 'exists:labels,id',
        ]);
        $task->fill($data);
        $task->createdBy()->associate(Auth::user());
        $task->save();
        $task->labels()->attach(Arr::get($data, 'label_id', []));
        flash(__('task.store'))->success()->important();
        return redirect()->route('task.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $assigners = User::all();
        $labels = Label::all();
        $statuses = Status::all();
        return view('task.edit', [
            'task' => $task,
            'statuses' => $statuses,
            'assigners' => $assigners,
            'labels' => $labels,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->all();
        $task->fill($data);
        $task->save();
        $task->labels()->attach(Arr::get($data, 'label_id', []));
        flash(__('task.update'))->important();
        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        $task->labels()->detach();
        $task->delete();
        flash(__('task.destroy'))->error()->important();
        return redirect()->route('task.index');
    }
}
