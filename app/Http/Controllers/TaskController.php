<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Task;
use App\Status;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()) {
            if(Auth::user()->hasVerifiedEmail()) {
                $users = User::all();
                $statuses = Status::all();
                return view('task.create', ['statuses' => $statuses, 'users' => $users]);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()) {
            if (Auth::user()->hasVerifiedEmail()) {
                $status = Status::find($request->post('status'));
                $user = Auth::user();
                $task = new Task();
                $task->name = $request->post('name');
                $task->description = $request->post('description');
                $task->status_id = $request->post('status');
                $task->created_by_id = Auth::user()->id;
                $task->assigned_by_id = $request->post('asignee');
                $user->createdTasks()->save($task);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()) {
            if (Auth::user()->hasVerifiedEmail()) {
                $tasks = Task::find($id);
                $users = User::all();
                $statuses = Status::all();
                return view('task.edit', ['task' => $task, 'statuses' => $statuses, 'users' => $users]);
            }
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
