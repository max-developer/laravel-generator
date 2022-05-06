<?php

namespace MwDevel\LaravelGenerator\Stub;

use Illuminate\Support\Str;

class Stub
{

    private array $data;
    private string $stubPath;

    public function __construct(string $stubPath, array $data)
    {
        $this->stubPath = $stubPath;
        $this->data = $data;
    }

    public function withData(string $name, $value): self
    {
        $this->data[strtoupper($name)] = $value;
        return $this;
    }

    public function withDataClass(string $prefix, string $class): self
    {
        $variables = self::getClassVariables($class);

        $prefix = strtoupper($prefix);
        $this->data[$prefix . '_CLASS'] = $class;
        foreach ($variables as $key => $value) {
            $this->data[$prefix . '_CLASS_' . $key] = $value;
        }

        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function render(): string
    {
        ob_start();
        include $this->stubPath;
        return ob_get_clean();
    }

    public function __get(string $name)
    {
        if (!array_key_exists($name, $this->data)) {
            throw new \InvalidArgumentException("Variable {$name} undefined");
        }
        return $this->data[$name];
    }

    public static function getClassVariables(string $class): array
    {
        $res = [];

        $res['NAME'] = class_basename($class);
        $res['NAME_PLURAL'] = Str::plural($res['NAME']);
        $res['NAMESPACE'] = trim(Str::replaceLast($res['NAME'], '', $class), '\\');
        $res['FQN'] = '\\' . $class;
        $res['FIELD'] = lcfirst($res['NAME']);
        $res['FIELD_PLURAL'] = Str::plural($res['FIELD']);
        $res['FIELD_SNAKE'] = Str::snake($res['FIELD']);
        $res['FIELD_SNAKE_PLURAL'] = Str::snake($res['FIELD_PLURAL']);
        $res['VARIABLE'] = '$' . $res['FIELD'];
        $res['VARIABLE_PLURAL'] = '$' . $res['FIELD_PLURAL'];
        $res['VARIABLE_SNAKE'] = '$' . $res['FIELD_SNAKE'];
        $res['VARIABLE_SNAKE_PLURAL'] = '$' . $res['FIELD_SNAKE_PLURAL'];
        $res['SINGULAR'] = Str::snake($res['FIELD'], ' ');
        $res['SINGULAR_UC'] = Str::ucfirst($res['SINGULAR']);
        $res['PLURAL'] = Str::plural($res['SINGULAR']);
        $res['PLURAL_UC'] = Str::ucfirst($res['SINGULAR_UC']);
        $res['SLUG'] = Str::slug($res['FIELD_SNAKE']);
        $res['SLUG_PLURAL'] = Str::slug($res['FIELD_SNAKE_PLURAL']);

        return $res;
    }

}
