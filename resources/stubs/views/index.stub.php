@extends('layouts.app')

@section('content')
    <h1 class="mb-3">{{ __('<?php echo $this->MODEL_CLASS_PLURAL_UC ?>') }}</h1>

    <x-button.link route="<?php echo $this->MODEL_CLASS_FIELD_SNAKE_PLURAL ?>.create" :label="__('Add')"/>

    <table class="table mt-2">
        <thead>
        <tr>
            <th>ID</th>
            <?php foreach ($this->FIELDS as $name => $field): ?>
            <th>{{ __('<?php echo data_get($field, 'label', $name) ?>') }}</th>
            <?php endforeach; ?>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach(<?php echo $this->MODEL_CLASS_VARIABLE_PLURAL ?> as <?php echo $this->MODEL_CLASS_VARIABLE ?>)
            <tr>
                <td class="col-1">{{<?php echo $this->MODEL_CLASS_VARIABLE ?>->id}}</td>
                <?php foreach ($this->FIELDS as $name => $field): ?>
                <td>{{<?php echo $this->MODEL_CLASS_VARIABLE ?>-><?php echo $name ?>}}</td>
                <?php endforeach; ?>
                <td class="col-2">
                    <x-button.link
                            variant="danger"
                            route="<?php echo $this->MODEL_CLASS_FIELD_SNAKE_PLURAL ?>.destroy"
                            :params="<?php echo $this->MODEL_CLASS_VARIABLE ?>"
                            :label="__('Delete')"
                            data-confirm="Are you sure?"
                            data-method="DELETE"
                    />
                    <x-button.link route="<?php echo $this->MODEL_CLASS_FIELD_SNAKE_PLURAL ?>.edit" :params="<?php echo $this->MODEL_CLASS_VARIABLE ?>" :label="__('Edit')"/>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
