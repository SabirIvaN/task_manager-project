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
        $this->authorizeResource(Status::class, 'status');
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
        $status->save();

        flash(__('statuses.store'))->success()->important();

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
        $status->save();

        flash(__('statuses.update'))->important();

        return redirect()->route('statuses.index');
    }

    public function destroy(Status $status)
    {
        $status->delete();

        flash(__('statuses.destroy'))->error()->important();

        return redirect()->route('statuses.index');
    }
}
