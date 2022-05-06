@extends('layouts.app')

@section('content')
    <h1 class="mb-3"></h1>

    <a href="{{ route('<?php echo $this->MODEL_CLASS_FIELD_SNAKE_PLURAL ?>.create') }}" class="btn btn-primary">Добавить</a>

    <table class="table mt-2">
        <thead>
        <tr>
            <th>ID</th>
            <?php foreach ($this->FIELDS as $name => $field): ?>
            <th><?php echo data_get($field, 'label', $name) ?></th>
            <?php endforeach; ?>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach(<?php echo $this->MODEL_CLASS_VARIABLE_PLURAL ?> as <?php echo $this->MODEL_CLASS_VARIABLE ?>)
            <tr>
                <td>{{<?php echo $this->MODEL_CLASS_VARIABLE ?>->id}}</td>
                <?php foreach ($this->FIELDS as $name => $field): ?>
                <td>{{<?php echo $this->MODEL_CLASS_VARIABLE ?>-><?php echo $name ?>}}</td>
                <?php endforeach; ?>
                <td>
                    <a class="text-danger text-decoration-none" href="{{route('<?php echo $this->MODEL_CLASS_FIELD_SNAKE_PLURAL ?>.destroy', $status)}}" data-confirm="Вы уверены?" data-method="DELETE">
                        Удалить
                    </a>
                    <a class="text-decoration-none" href="{{route('<?php echo $this->MODEL_CLASS_FIELD_SNAKE_PLURAL ?>.edit', $status)}}">
                        Изменить
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
