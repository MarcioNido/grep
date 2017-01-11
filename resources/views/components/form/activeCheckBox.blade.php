<div class="checkbox-inline">
    <label>
        {{ Form::hidden($name, 0) }}
        {{ Form::checkbox($name, 1, $checked) }}
        {{ $label }}
    </label>
</div>
