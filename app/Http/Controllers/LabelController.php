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
        return view('label.index', ['labels' => $labels]);
    }

    public function create()
    {
        $label = new Label();
        return view('label.create', ['label' => $label]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:labels|max:50',
        ]);
        $label = new Label();
        $label->fill($data);
        if (!$label->save()) {
            flash(__('label.savingFailed'))->error()->important();
            return redirect()->route('label.index');
        }
        flash(__('label.store'))->success()->important();
        return redirect()->route('label.index');
    }

    public function edit(Label $label)
    {
        return view('label.edit', ['label' => $label]);
    }

    public function update(Request $request, Label $label)
    {
        $data = $request->validate([
            'name' => 'required|unique:labels|max:50',
        ]);
        $label->fill($data);
        $label->save();
        if (!$label->save()) {
            flash(__('label.updatingFailed'))->error()->important();
            return redirect()->route('label.index');
        }
        flash(__('label.update'))->important();
        return redirect()->route('label.index');
    }

    public function destroy(Label $label)
    {
        if ($label->tasks()->exists()) {
            flash(__('label.rejected'))->error()->important();
            return redirect()->route('label.index');
        }
        $label->tasks()->detach();
        if (!$label->delete()) {
            flash(__('label.deletingFailed'))->error()->important();
            return redirect()->route('label.index');
        }
        flash(__('label.destroy'))->error()->important();
        return redirect()->route('label.index');
    }
}
