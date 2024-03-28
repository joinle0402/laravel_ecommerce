<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function getClasses(string $folderPath): Collection
    {
        return collect(File::files($folderPath))
            ->map(fn ($item) => (
            str($item->getPathname())
                ->replace("app", "App")
                ->remove(base_path())
                ->remove('.php')
                ->ltrim('\\')
                ->toString()
            ));
    }

    public function register(): void
    {
        $interfaces = $this->getClasses(app_path('Repositories\Interfaces'));
        $implementations = $this->getClasses(app_path('Repositories\Implementations'));
        foreach ($interfaces as $index => $interface) {
            $this->app->singleton($interfaces[$index], $implementations[$index]);
        }

        $interfaces = $this->getClasses(app_path('Services\Interfaces'));
        $implementations = $this->getClasses(app_path('Services\Implementations'));
        foreach ($interfaces as $index => $interface) {
            $this->app->singleton($interfaces[$index], $implementations[$index]);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
