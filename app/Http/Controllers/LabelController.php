<?php

namespace App\Http\Controllers;

use App\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
    {
        $labels = Label::all();

        return view('labels.index', ['labels' => $labels]);
    }

    public function create()
    {

        $label = new Label();

        return view('labels.create', ['label' => $label]);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|unique:labels|max:50',
        ]);

        $label = new Label();
        $label->fill($data);

        if (!$label->save()) {
            flash(__('labels.savingFailed'))->error()->important();
        } else {
            flash(__('labels.store'))->success()->important();
        }

        return redirect()->route('labels.index');
    }

    public function edit(Label $label)
    {
        return view('labels.edit', ['label' => $label]);
    }

    public function update(Request $request, Label $label)
    {
        $data = $request->validate([
            'name' => 'required|unique:labels|max:50',
        ]);

        $label->fill($data);
        $label->save();

        if (!$label->save()) {
            flash(__('labels.updatingFailed'))->error()->important();
        } else {
            flash(__('labels.update'))->important();
        }

        return redirect()->route('labels.index');
    }

    public function destroy(Label $label)
    {
        $label->tasks()->detach();

        if (!$label->delete()) {
            flash(__('labels.deletingFailed'))->error()->important();
        } else {
            flash(__('labels.destroy'))->error()->important();
        }

        return redirect()->route('labels.index');
    }
}
