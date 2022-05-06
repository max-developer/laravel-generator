{{Form::model(<?php echo $this->MODEL_CLASS_VARIABLE ?>, ['url' => $url, 'method' => $method ?? 'POST'])}}
    <?php foreach ($this->FIELDS as $name => $field): ?>
    <div class="form-group">
        {{Form::label('<?php echo $name ?>', '<?php echo data_get($field, 'label', $name) ?>')}}
        <?php if (data_get($field, 'type') === 'textarea'): ?>
        {{Form::textarea('<?php echo $name ?>', null, ['class' => 'form-control'])}}
        <?php elseif (data_get($field, 'type') === 'select'): ?>
        {{Form::select('<?php echo $name ?>', null, ['class' => 'form-control'])}}
        <?php else: ?>
        {{Form::text('<?php echo $name ?>', null, ['class' => 'form-control'])}}
        <?php endif; ?>
        @error('<?php echo $name ?>')<div class="invalid-feedback">{{$errors->first('<?php echo $name ?>')}}</div>@enderror
    </div>
    <?php endforeach; ?>
    <div class="form-check">
        {{Form::submit($submitText ?? 'Save', ['class' => 'btn btn-primary mt-3'])}}
    </div>
{{Form::close()}}
