<?php

namespace MwDevel\LaravelGenerator\Commands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use MwDevel\LaravelGenerator\QuestionFactory;
use MwDevel\LaravelGenerator\Stub\Stub;
use MwDevel\LaravelGenerator\Stub\StubFactory;
use Illuminate\Console\Command;

abstract class CrudMakeCommand extends Command
{
    protected QuestionFactory $questionFactory;
    protected StubFactory $stubFactory;
    private Filesystem $files;

    public function __construct(Filesystem $files, QuestionFactory $questionFactory, StubFactory $stubFactory)
    {
        $this->questionFactory = $questionFactory;
        $this->stubFactory = $stubFactory;
        $this->files = $files;
        parent::__construct();
    }

    protected function generateView(string $viewName, Stub $stub): void
    {
        $path = $this->getPathBlade($viewName);

        if ($this->alreadyExists($path)) {
            $this->getOutput()->error(sprintf('View "%s" exists', $viewName));
            return;
        }

        $this->writeFile($path, $stub->render());

        $this->getOutput()->success(sprintf('View "%s" created', $viewName));
    }

    protected function generateClass(string $class, Stub $stub): void
    {
        $path = $this->getPathClass($class);

        if ($this->alreadyExists($path)) {
            $this->getOutput()->error('Class "' . $class . '" exists');
            return;
        }

        $this->writeFile($path, $stub->render());

        $this->getOutput()->success(sprintf('Class "%s" created', $class));
    }

    protected function getQuestionController(): ?string
    {
        $question = $this->questionFactory->make('Controller name?')
            ->setValidator($this->questionFactory->makeValidator('required'));

        $class = $this->getOutput()->askQuestion($question);

        return $this->qualifyClass('Http.Controllers', $class);
    }

    protected function getQuestionModel(): ?string
    {
        $question = $this->questionFactory->make('Model class?')
            ->setValidator($this->questionFactory->makeValidator('required'));

        $class = $this->getOutput()->askQuestion($question);

        return $this->qualifyClass('Models', $class);
    }

    protected function getQuestionService(): ?string
    {
        $question = $this->questionFactory->make('Service class?')
            ->setValidator($this->questionFactory->makeValidator('required'));

        $class = $this->getOutput()->askQuestion($question);

        return $this->qualifyClass('Services', $class);
    }

    protected function qualifyClass(string $prefix, string $class): string
    {
        $namespace = $this->laravel->getNamespace() . str_replace('.', '\\', $prefix);
        $class = trim($class, '\\');

        return Str::startsWith($class, $namespace) ? $class : $namespace . '\\' . $class;
    }

    protected function getPathClass(string $class): string
    {
        $class = Str::replaceFirst($this->laravel->getNamespace(), '', $class);
        return $this->laravel['path'] . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    }

    protected function getPathBlade(string $viewName): string
    {
        $viewName = str_replace('.', DIRECTORY_SEPARATOR, 'views.' . $viewName);
        return $this->laravel->resourcePath($viewName) . '.blade.php';
    }

    protected function alreadyExists(string $path): bool
    {
        return $this->files->exists($path);
    }

    protected function makeDirectory(string $path): string
    {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        return $path;
    }

    protected function writeFile(string $path, string $contents)
    {
        $this->makeDirectory($path);
        return $this->files->put($path, $contents);
    }

}
