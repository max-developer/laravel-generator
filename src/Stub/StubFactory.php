<?php

namespace MwDevel\LaravelGenerator\Stub;


class StubFactory
{
    private array $basePaths;

    public function __construct(string ...$basePaths)
    {
        $this->basePaths = $basePaths;
    }

    public function make(string $stubName, array $data = []): Stub
    {
        foreach ($this->basePaths as $path) {
            $stubPath = $path . DIRECTORY_SEPARATOR . str_replace('.', DIRECTORY_SEPARATOR, $stubName) . '.stub.php';
            if (file_exists($stubPath)) {
                return new Stub($stubPath, $data);
            }
        }
        throw new \RuntimeException("Stub '{$stubName}' not found");
    }
}
