<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeRepositoryInterface extends GeneratorCommand
{
    protected $hidden = true;
    protected $signature = 'make:repository-interface {name}';
    protected $description = 'Command description';
    protected $type = 'Repository Interface';

    protected function getStub(): string
    {
        return app_path('Console/Stubs/MakeRepositoryInterfaceTemplate.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Repositories\Interfaces';
    }
}
