<x-form :action="$url" :method="$method ?? 'POST'">
    <?php foreach ($this->FIELDS as $name => $field): ?>
        <div class="form-group">
            <?php if (data_get($field, 'type') === 'textarea'): ?>
                <x-form.control :model="<?php echo $this->MODEL_CLASS_VARIABLE ?>" name="<?php echo $name ?>" type="textarea" label="<?php echo data_get($field, 'label', $name) ?>"/>
            <?php elseif (data_get($field, 'type') === 'select'): ?>
                <x-form.select :model="<?php echo $this->MODEL_CLASS_VARIABLE ?>" name="<?php echo $name ?>" :list="[]"/>
            <?php else: ?>
                <x-form.control :model="<?php echo $this->MODEL_CLASS_VARIABLE ?>" name="<?php echo $name ?>" label="<?php echo data_get($field, 'label', $name) ?>"/>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    <div class="form-group">
        <x-form.submit :value="$submitText ?? 'Save'" />
    </div>
</x-form>
