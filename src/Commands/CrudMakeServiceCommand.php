<?php

namespace MwDevel\LaravelGenerator\Commands;


class CrudMakeServiceCommand extends CrudMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:make:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make crud service';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $serviceClass = $this->getQuestionService();
        $modelClass = $this->getQuestionModel();

        $stub = $this->stubFactory->make('service');
        $stub->withDataClass('MODEL', $modelClass);
        $stub->withDataClass('SERVICE', $serviceClass);

        $this->generateClass($serviceClass, $stub);
    }

}
