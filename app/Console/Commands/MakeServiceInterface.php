<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeServiceInterface extends GeneratorCommand
{
    protected $hidden = true;
    protected $signature = 'make:service-interface {name}';
    protected $description = 'Make service interface command';

    protected function getStub(): string
    {
        return app_path('Console/Stubs/MakeServiceInterfaceTemplate.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Services\Interfaces';
    }
}
