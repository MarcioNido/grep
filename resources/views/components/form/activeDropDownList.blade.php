<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    @if ($label != '')
    <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <?= Form::select($name, $data, $value, $attributes) ?>
    @if ($errors->has($name))
        <span class="help-block">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>