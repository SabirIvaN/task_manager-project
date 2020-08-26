<?php

namespace App\Http\Controllers;

use Auth;
use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();
        return view('status.index', ['statuses' => $statuses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()) {
            if (Auth::user()->hasVerifiedEmail()) {
                return view('status.create');
            }
        }
        abort(404);
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
                $status = new Status();
                $status->name = $request->post('name');
                $status->save();
                flash(__('status.store'))->success()->important();
                return redirect()->route('status.index');
            }
        }
        abort(404);
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
                $status = Status::find($id);
                return view('status.edit', ['status' => $status]);
            }
        }
        abort(404);
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
        if (Auth::user()) {
            if (Auth::user()->hasVerifiedEmail()) {
                $status = Status::find($id);
                $status->name = $request->post('name');
                $status->save();
                flash(__('status.update'))->important();
                return redirect()->route('status.index');
            }
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()) {
            if (Auth::user()->hasVerifiedEmail()) {
                $status = Status::find($id);
                $status->delete();
                flash(__('status.destroy'))->error()->important();
                return redirect()->route('status.index');
            }
        }
        abort(404);
    }
}
