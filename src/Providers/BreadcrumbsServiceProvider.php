<?php

namespace JasonStainton\Breadcrumbs\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

class BreadcrumbsServiceProvider extends ServiceProvider
{
    public function boot()
    {      
        $this->loadViewsFrom(__DIR__ . '/../../views', 'breadcrumbs');

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('breadcrumbs.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../../views' => resource_path('views/vendor/breadcrumbs'),
        ], 'views');

        Blade::directive('breadcrumbs', function($expression)
        {
            return "<?php echo \JasonStainton\Breadcrumbs\Helpers\Renderer::renderBreadcrumbs($expression); ?>";
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'breadcrumbs'
        );
    }
}
