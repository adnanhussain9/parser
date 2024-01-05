<?php

namespace Adnan\Parser;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Parsedown;

class ParsedownServiceProvider extends ServiceProvider
{
    /**
     * delay to load service.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * boot a service.
     *
     * @author 
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app instanceof LaravelApplication
            && $this->app->runningInConsole()
        ) {
            $this->publishes(
                [
                    __DIR__.'/config/markdown.php' => config_path('markdown.php'),
                ],
                'laravel-parsedown-config'
            );
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('markdown');
        }

        Blade::directive('parsedown', function ($expression) {
            return "<?php echo parsedown($expression); ?>";
        });
    }

    /**
     * registe the service.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__).'/config/markdown.php', 'markdown');

        $this->app->singleton(Parsedown::class, function () {
            return Parsedown::instance()->setSafeMode(config('markdown.parsedown.safeMode'))
                ->setBreaksEnabled(config('markdown.parsedown.breaksEnabled'))
                ->setMarkupEscaped(config('markdown.parsedown.markupEscaped'))
                ->setUrlsLinked(config('markdown.parsedown.urlsLinked'));
        });

        $this->app->alias(Parsedown::class, 'parsedown');
    }

    /**
     * providers.
     *
     * @return array
     */
    public function provides()
    {
        return [Parsedown::class, 'parsedown'];
    }
}