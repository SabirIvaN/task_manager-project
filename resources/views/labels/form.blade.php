<div class="form-group col-md-12">
    {{ Form::label('name', __('label.name')) }}

    {{ Form::text('name', $label->name, ['class' => 'form-control mr-2' . ($errors->has('name') ? ' is-invalid' : '')]) }}

    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group col-md-12">
    {{ Form::submit(__('label.save'), ['class' => 'btn btn-primary']) }}
</div>
