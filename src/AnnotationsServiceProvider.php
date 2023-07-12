<?php
namespace TqCommentssrv\TqCommentssrv;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AnnotationsServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->registerRoutes();
        $this->loadMigrations();
        $this->loadModels();
        $this->loadConfig();
    }

    private function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->publishes(
            [
                __DIR__ . '/../routes' => base_path('routes'),
            ],
            'annotations-package'
        );
        

    }

    private function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes(
            [
                __DIR__ . '/../database/migrations' => base_path('database/migrations'),
            ],
            'annotations-package'
        );
    }

    private function loadControllers()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Http/Controllers/AnnotationsController.php');

        $this->publishes(
            [
                __DIR__ . '/Http/Controllers/AnnotationsController.php' => base_path('app/Http/Controllers/AnnotationController.php'),
            ],
            'annotations-package'
        );
    }

    private function loadModels()
    {
        $this->publishes(
            [
                __DIR__ . '/Models/AnAnnotation.php' => base_path('app/Models/AnAnnotation.php'),
                __DIR__ . '/Models/AnLogMessages.php' => base_path('app/Models/AnLogMessages.php'),
            ],
            'annotations-package'
        );
    }

    private function loadConfig()
    {
        $this->publishes([
            __DIR__.'/../config/annotation.php' => config_path('annotation.php'),
        ],'annotations-package');
    }
}