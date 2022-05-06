@extends('layouts.app')

@section('content')
    <h1 class="mb-5">Создать</h1>

    @include('<?php echo $this->VIEW_DIR ?>._form', [
        'url' => route('<?php echo $this->MODEL_CLASS_FIELD_SNAKE_PLURAL ?>.store'),
        'submitText' => 'Создать'
    ])
@endsection


