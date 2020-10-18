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

        return view('status.index', ['statuses' => $statuses]);
    }

    public function create()
    {
        $status = new Status();

        return view('status.create', ['status' => $status]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:statuses|max:50',
        ]);

        $status = new Status();
        $status->fill($data);

        if (!$status->save()) {
            flash(__('status.savingFailed'))->success()->important();
        } else {
            flash(__('status.store'))->success()->important();
        }

        return redirect()->route('status.index');
    }

    public function edit(Status $status)
    {
        return view('status.edit', ['status' => $status]);
    }

    public function update(Request $request, Status $status)
    {
        $data = $request->validate([
            'name' => 'required|unique:statuses|max:50',
        ]);

        $status->fill($request->all());

        if (!$status->save()) {
            flash(__('status.updatingFailed'))->error()->important();
        } else {
            flash(__('status.update'))->important();
        }
        return redirect()->route('status.index');
    }

    public function destroy(Status $status)
    {
        $this->authorize('delete', $status);

        if (!$status->delete()) {
            flash(__('status.deletingFailed'))->error()->important();
        } else {
            flash(__('status.destroy'))->error()->important();
        }

        return redirect()->route('status.index');
    }
}
