<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    <label for="$name">{{ $label }}</label>
    <?= Form::textArea($name, $value, array_merge(['class' => 'form-control'], $attributes)) ?>
    @if ($errors->has($name))
        <span class="help-block">
             <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>
