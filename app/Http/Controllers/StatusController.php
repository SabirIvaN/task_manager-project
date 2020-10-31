<?php

namespace App\Http\Controllers;

use Auth;
use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
    {
        $statuses = Status::all();

        return view('statuses.index', ['statuses' => $statuses]);
    }

    public function create()
    {
        $status = new Status();

        return view('statuses.create', ['status' => $status]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:statuses|max:50',
        ]);

        $status = new Status();
        $status->fill($data);

        if (!$status->save()) {
            flash(__('statuses.savingFailed'))->success()->important();
        } else {
            flash(__('statuses.store'))->success()->important();
        }

        return redirect()->route('statuses.index');
    }

    public function edit(Status $status)
    {
        return view('statuses.edit', ['status' => $status]);
    }

    public function update(Request $request, Status $status)
    {
        $data = $request->validate([
            'name' => 'required|max:50',
        ]);

        $status->fill($request->all());

        if (!$status->save()) {
            flash(__('statuses.updatingFailed'))->error()->important();
        } else {
            flash(__('statuses.update'))->important();
        }
        return redirect()->route('statuses.index');
    }

    public function destroy(Status $status)
    {
        $this->authorize('delete', $status);

        if (!$status->delete()) {
            flash(__('statuses.deletingFailed'))->error()->important();
        } else {
            flash(__('statuses.destroy'))->error()->important();
        }

        return redirect()->route('statuses.index');
    }
}
