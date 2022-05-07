<?php

namespace MwDevel\LaravelGenerator;

use Illuminate\Support\ServiceProvider as SupportServiceProvider;
use MwDevel\LaravelGenerator\Commands\CrudMakeControllerCommand;
use MwDevel\LaravelGenerator\Commands\CrudMakeServiceCommand;
use MwDevel\LaravelGenerator\Commands\CrudMakeViewCommand;
use MwDevel\LaravelGenerator\Commands\CrudViewPublishCommand;
use MwDevel\LaravelGenerator\Stub\StubFactory;

class ServiceProvider extends SupportServiceProvider
{
    public function register()
    {
        $this->app->singleton(StubFactory::class, fn() => new StubFactory(
            $this->app->resourcePath('stubs'),
            __DIR__ . '/../resources/stubs',
        ));
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CrudMakeControllerCommand::class,
                CrudMakeServiceCommand::class,
                CrudMakeViewCommand::class,
                CrudViewPublishCommand::class,
            ]);
        }

        $this->addPublishes('form');
        $this->addPublishes('button');
    }

    protected function addPublishes(string $component): void
    {
        $this->publishes([
            __DIR__.'/../resources/views/components/' . $component => $this->app->resourcePath('views/components/' . $component)
        ], 'crud-components-' . $component);
    }
}
