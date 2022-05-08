<?php

namespace MwDevel\LaravelGenerator\Commands;

use Illuminate\Console\Command;

class CrudViewPublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:view:publish 
                                {name : The name of the component (form|button|all)} 
                                {--force=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make crud controller';

    /**
     * @var array|string[]
     */
    protected array $names = [
        'form',
        'button',
        'pagination',
    ];

    public function handle()
    {
        foreach ($this->getNames() as $name) {
            $tag = sprintf('crud-components-%s', $name);
            $this->call('vendor:publish', array_merge(
                ['--tag' => $tag],
                $this->option('force') ? ['--force'] : [],
            ));
        }
    }

    protected function getNames(): array
    {
        $name = $this->argument('name');
        return $name === 'all' ? $this->names : [$name];
    }

}
