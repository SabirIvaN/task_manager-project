<div class="form-group col-md-6">
    {{ Form::label('name', __('tasks.name')) }}

    {{ Form::text('name', $task->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) }}

    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group col-md-6">
    {{ Form::label('description', __('tasks.description')) }}

    {{ Form::textarea('description', $task->name, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : '')]) }}

    @error('description')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group col-md-6">
    {{ Form::label('assigned_to_id', __('tasks.assignee')) }}

    {{ Form::select('assigned_to_id', $assigners, $task->assigned_to_id ?? null, ['class' => 'form-control', 'placeholder' => __('tasks.assigners')]) }}
</div>
<div class="form-group col-md-6">
    {{ Form::label('status_id', __('tasks.status')) }}

    {{ Form::select('status_id', $statuses, $task->status_id ?? null, ['class' => 'form-control' . ($errors->has('status_id') ? ' is-invalid' : ''), 'placeholder' => __('tasks.statuses')]) }}

    @error('status_id')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group col-md-6">
    {{ Form::label('label_id', __('tasks.label')) }}

    {{ Form::select('label_id[]', $labels, $task->labels, ['class' => 'chosen-select', 'multiple' => true]) }}
</div>
<div class="form-group col-md-12">
    {{ Form::submit(__('tasks.save'), ['class' => 'btn btn-primary']) }}
</div>
