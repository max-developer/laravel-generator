<?php

namespace MwDevel\LaravelGenerator\Commands;


class CrudMakeControllerCommand extends CrudMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:make:controller {--api=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make crud controller';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $controllerClass = $this->getQuestionController();
        $modelClass = $this->getQuestionModel();
        $serviceClass = $this->getQuestionService();

        $stub = $this->stubFactory->make($this->getStubName());
        $stub->withDataClass('CONTROLLER', $controllerClass);
        $stub->withDataClass('MODEL', $modelClass);
        $stub->withDataClass('SERVICE', $serviceClass);

        $this->generateClass($controllerClass, $stub);
    }

    protected function getStubName(): string
    {
        if ($this->option('api')) {
            return 'controller_api';
        }
        return 'controller';
    }

}
