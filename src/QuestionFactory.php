<?php

namespace MwDevel\LaravelGenerator;

use Illuminate\Contracts\Validation\Factory;
use Symfony\Component\Console\Question\Question;

class QuestionFactory
{
    private Factory $validatorFactory;

    public function __construct(Factory $validatorFactory)
    {
        $this->validatorFactory = $validatorFactory;
    }

    public function make(string $question, $default = null): Question
    {
        return new Question($question, $default);
    }

    public function makeValidator($rules): callable
    {
        return function ($value) use ($rules) {
            $validator = $this->validatorFactory->make(['value' => $value], ['value' => $rules]);
            if ($validator->fails()) {
                throw new \RuntimeException($validator->errors()->first());
            }

            return $value;
        };
    }
}
