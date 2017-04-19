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
            __DIR__ . '/../../views' => resource_path('views/vendor/breadcrumbs'),
        ]);

        Blade::directive('breadcrumbs', function($expression)
        {
            return "<?php echo \JasonStainton\Breadcrumbs\Helpers\Renderer::renderBreadcrumbs($expression); ?>";
        });
    }

    public function register() {}
}
