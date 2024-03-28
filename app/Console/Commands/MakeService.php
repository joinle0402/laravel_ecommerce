<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeService extends GeneratorCommand
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create a new service file';

    protected function getNameInput(): string
    {
        return $this->argument('name').'ServiceImplementation';
    }

    protected function getStub(): string
    {
        return app_path('Console/Stubs/MakeServiceTemplate.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Services\Implementations';
    }

    protected function replaceNamespace(&$stub, $name): GeneratorCommand
    {
        $serviceClass = $this->getNameInput();
        $classname = str($this->getNameInput())->remove('ServiceImplementation');
        $serviceInterface = $classname.'Service';
        $repositoryInterface = $classname.'Repository';
        $repositoryInstance = lcfirst($classname).'Repository';

        $parameters = [
            '{{ namespace }}' => 'App\Services\Implementations',
            '{{ Model }}' => $classname,
            '{{ modelNamespace }}' => 'App\Models\\'.$classname,
            '{{ ServiceClass }}' => $serviceClass,
            '{{ ServiceInterface }}' => $serviceInterface,
            '{{ RepositoryInterface }}' => $repositoryInterface,
            '{{ RepositoryInstance }}' => $repositoryInstance,
        ];
        $stub = str_replace(array_keys($parameters), array_values($parameters), $stub);

        return parent::replaceNamespace($stub, $serviceClass);
    }

    public function handle(): ?bool
    {
        $this->call('make:service-interface', ['name' => str($this->getNameInput())->remove('Implementation')]);
        return parent::handle();
    }

}
