<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeRepository extends GeneratorCommand
{
    protected $signature = 'make:repository {name} {--Q|queue}';
    protected $description = 'Create a new repository file';
    protected $type = 'Repository';

    protected function getNameInput(): string
    {
        return $this->argument('name').'RepositoryImplementation';
    }

    protected function getStub(): string
    {
        return app_path('Console/Stubs/MakeRepositoryTemplate.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Repositories\Implementations';
    }

    protected function replaceNamespace(&$stub, $name): GeneratorCommand
    {
        $repositoryClass = $this->getNameInput();
        $classname = str($this->getNameInput())->remove('RepositoryImplementation');
        $repositoryInterface = $classname.'Repository';

        $parameters = [
            '{{ namespace }}' => 'App\Repositories\Implementations',
            '{{ Model }}' => $classname,
            '{{ modelNamespace }}' => 'App\Models\\'.$classname,
            '{{ RepositoryClass }}' => $repositoryClass,
            '{{ RepositoryInterface }}' => $repositoryInterface,
        ];
        $stub = str_replace(array_keys($parameters), array_values($parameters), $stub);

        return parent::replaceNamespace($stub, $repositoryClass);
    }

    public function handle(): ?bool
    {
        $this->call('make:repository-interface', ['name' => str($this->getNameInput())->remove('Implementation')]);
        return parent::handle();
    }

}
