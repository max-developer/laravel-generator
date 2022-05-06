<?php

namespace MwDevel\LaravelGenerator\Commands;

class CrudMakeViewCommand extends CrudMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:make:view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make crud view';

    protected array $views = [
        '_form',
        'index',
        'create',
        'edit',
        'show',
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $viewName = $this->getQuestionView();
        $modelClass = $this->getQuestionModel();

        $fields = $this->getFields($modelClass);

        foreach ($this->views as $name) {
            $view = sprintf('%s.%s', $viewName, $name);

            $stub = $this->stubFactory->make('views.' . $name);
            $stub->withDataClass('MODEL', $modelClass);
            $stub->withData('FIELDS', $fields);
            $stub->withData('VIEW_DIR', $viewName);

            $this->generateView($view, $stub);
        }
    }

    protected function getQuestionView(): ?string
    {
        $question = $this->questionFactory->make('View name directory?')
            ->setValidator($this->questionFactory->makeValidator('required'));

        return $this->getOutput()->askQuestion($question);
    }

    protected function getFields(string $modelClass): array
    {
        $fields = [];

        if (class_exists($modelClass)) {
            $model = new $modelClass();

            foreach ($model->getFillable() as $name) {
                $fields[$name] = ['label' => $name, 'type' => 'text'];
            }
        }

        return $fields;
    }

}
