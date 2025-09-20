<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use ReflectionClass;

class ModuleServiceProvider extends ServiceProvider
{
    protected ?string $configAlias = null;

    protected array $policies = [];

    protected array $listens = [];

    protected array $routes = [];

    /** Draft */
    protected array $routeModels = [];

    public function boot()
    {
        $this->registerConfig();
        $this->registerSearchSettings();
        $this->registerPolicies();
        $this->registerRoutes();
        $this->registerMigrations();
        $this->registerListens();
        $this->registerRouteModels();
    }

    public function registerConfig(): void
    {
        if($this->configAlias()) {
            $this->mergeConfigFrom(
                $this->getDir() . '/../Config/module.php', $this->configAlias(),
            );
        }
    }

    public function registerSearchSettings(): void
    {
       $filePath = $this->getDir() . '/../Config/search.php';

        if (!file_exists($filePath)) {
            return;
        }

        $indexSettings = [];

        $indexSettings = config('scout.meilisearch.index-settings', []);

        $searchSettings = require $filePath;

        foreach ($searchSettings as $key => $value) {
            $indexSettings[$key] = $value;
        }

        config(['scout.meilisearch.index-settings' => $indexSettings]);
    }

    public function registerPolicies(): void
    {
        foreach ($this->policies() as $model => $policy) {
            Gate::policy($model, $policy);
        }
    }

    public function registerRoutes(): void
    {
        foreach ($this->routes() as $route) {
            $this->loadRoutesFrom($this->getDir() . '/../Routes/' . $route . '.php');
        }
    }

    public function registerRouteModels(): void
    {
        foreach ($this->routeModels() as $modelAlias => $modelClass) {
            Route::model($modelAlias, $modelClass);
        }
    }

    public function registerMigrations(): void
    {
        $this->loadMigrationsFrom($this->getDir() . '/../Database/Migrations');
    }

    public function registerListens(): void
    {
        foreach ($this->listens() as $event => $listeners) {
            foreach (array_unique($listeners, SORT_REGULAR) as $listener) {
                Event::listen($event, $listener);
            }
        }
    }

    public function policies(): array
    {
        return $this->policies;
    }

    public function routes(): array
    {
        return $this->routes;
    }

    public function routeModels(): array
    {
        return $this->routeModels;
    }

    public function listens(): array
    {
        return $this->listens;
    }

    public function configAlias(): ?string
    {
        return $this->configAlias;
    }

    protected function getDir(): string
    {
        $reflector = new ReflectionClass(get_class($this));
        $filename = $reflector->getFileName();
        return dirname($filename);
    }
}
