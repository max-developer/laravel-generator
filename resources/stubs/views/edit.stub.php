@extends('layouts.app')

@section('content')
    <h1 class="mb-5">Редактировать статус</h1>

    @include('<?php echo $this->VIEW_DIR ?>._form', [
        'method' => 'PATCH',
        'url' => route('<?php echo $this->MODEL_CLASS_FIELD_SNAKE_PLURAL ?>.update', <?php echo $this->MODEL_CLASS_VARIABLE ?>),
        'submitText' => 'Сохранить'
    ])
@endsection


