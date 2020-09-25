<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Task;
use App\Label;
use App\Status;
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = QueryBuilder::for(Task::class)
        ->allowedFilters([AllowedFilter::exact('status_id')])
        ->get();
        $request = $request->post('filter');
        if (isset($request)) {
            if ($request['status_id'] == 'all') {
                $tasks = Task::all();
            }
        }
        $filters = Task::all();
        return view('task.index', ['tasks' => $tasks, 'filters' => $filters, 'request' => $request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $statuses = Status::all();
        $labels = Label::all();
        return view('task.create', ['statuses' => $statuses, 'users' => $users, 'labels' => $labels]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();
        $task->name = $request->post('name');
        $task->description = $request->post('description');
        $labels = Label::find($request->post('label'));
        Status::find($request->post('status'))->tasks()->save($task);
        Auth::user()->createdBy()->save($task);
        User::find($request->post('asignee'))->assignedTo()->save($task);
        $task->labels()->attach($labels);
        flash(__('task.store'))->success()->important();
        return redirect()->route('task.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $users = User::all();
        $labels = Label::all();
        $statuses = Status::all();
        return view('task.edit', ['task' => $task, 'statuses' => $statuses, 'users' => $users, 'labels' => $labels]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->status()->dissociate();
        $task->assigner()->dissociate();
        $task->labels()->detach();
        $task->name = $request->post('name');
        $task->description = $request->post('description');
        $labels = Label::find($request->post('label'));
        Status::find($request->post('status'))->tasks()->save($task);
        User::find($request->post('asignee'))->assignedTo()->save($task);
        $task->labels()->attach($labels);
        flash(__('task.update'))->important();
        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->status()->dissociate();
        $task->creator()->dissociate();
        $task->assigner()->dissociate();
        $task->labels()->detach();
        $task->delete();
        flash(__('task.destroy'))->error()->important();
        return redirect()->route('task.index');
    }
}
