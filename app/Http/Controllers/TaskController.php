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

use function App\Helpers\ArrayGetters\getStatus;
use function App\Helpers\ArrayGetters\getUsers;
use function App\Helpers\ArrayGetters\getLabels;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
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
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->get();
        $users = User::all();
        $statuses = Status::all();
        $statusesArray = getStatus($statuses);
        $creatorsArray = getUsers($users);
        $assignersArray = getUsers($users);
        return view('task.index', [
            'tasks' => $tasks,
            'users' => $users,
            'statuses' => $statuses,
            'statusesArray' => $statusesArray,
            'creatorsArray' => $creatorsArray,
            'assignersArray' => $assignersArray,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $task = new Task();
        $users = User::all();
        $labels = Label::all();
        $statuses = Status::all();
        $statusesArray = getStatus($statuses);
        $assignersArray = getUsers($users);
        $labelsArray = getLabels($labels);
        return view('task.create', [
            'task' => $task,
            'users' => $users,
            'labels' => $labels,
            'statuses' => $statuses,
            'labelsArray' => $labelsArray,
            'statusesArray' => $statusesArray,
            'assignersArray' => $assignersArray,
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
            return redirect()->route('task.index');
        }
        $task->labels()->sync(Arr::get($data, 'label_id', []));
        flash(__('task.store'))->success()->important();
        return redirect()->route('task.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(Task $task)
    {
        if (Auth::user()->id !== $task->createdBy->id) {
            flash(__('task.preventEdited'))->error()->important();
            return redirect()->route('task.index');
        }
        $users = User::all();
        $labels = Label::all();
        $statuses = Status::all();
        $statusesArray = getStatus($statuses);
        $assignersArray = getUsers($users);
        $labelsArray = getLabels($labels);
        return view('task.edit', [
            'statuses' => $statuses,
            'users' => $users,
            'labels' => $labels,
            'task' => $task,
            'labelsArray' => $labelsArray,
            'statusesArray' => $statusesArray,
            'assignersArray' => $assignersArray,
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
            return redirect()->route('task.index');
        }
        $task->labels()->sync(Arr::get($data, 'label_id', []));
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
        if (Auth::user()->id !== $task->createdBy->id) {
            flash(__('task.preventDeleted'))->error()->important();
            return redirect()->route('task.index');
        }
        $task->labels()->detach();
        if (!$task->delete()) {
            flash(__('task.deletingFailed'))->error()->important();
            return redirect()->route('task.index');
        }
        flash(__('task.destroy'))->error()->important();
        return redirect()->route('task.index');
    }
}
