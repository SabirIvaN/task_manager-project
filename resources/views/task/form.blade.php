<div class="form-group col-md-6">
    {{ Form::label('name', __('task.name')) }}

    {{ Form::text('name', $task->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) }}

    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group col-md-6">
    {{ Form::label('description', __('task.description')) }}

    {{ Form::text('description', $task->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : '')]) }}

    @error('description')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group col-md-6">
    {{ Form::label('assigned_to_id', __('task.assignee')) }}

    {{ Form::select('assigned_to_id', $users->mapWithKeys(function ($user) {
        return [$user->id => $user->name];
    }), $task->assigned_to_id ?? null, ['class' => 'form-control']) }}
</div>
<div class="form-group col-md-6">
    {{ Form::label('status_id', __('task.status')) }}

    {{ Form::select('status_id', $statuses->mapWithKeys(function ($status) {
        return [$status->id => $status->name];
    }), $task->status_id ?? null, ['class' => 'form-control']) }}
</div>
<div class="form-group col-md-6">
    {{ Form::label('label_id', __('task.label')) }}

    {{ Form::select('label_id[]', $labels->mapWithKeys(function ($label) {
        return [$label->id => $label->name];
    }), $task->labels, ['class' => 'chosen-select', 'multiple' => true]) }}
</div>
<div class="form-group col-md-12">
    {{ Form::submit(__('task.save'), ['class' => 'btn btn-primary']) }}
</div>
