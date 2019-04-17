<?php

namespace Laravie\Stream\Laravel;

use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use Illuminate\Support\ServiceProvider;
use React\Stream\WritableResourceStream;
use React\Stream\WritableStreamInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\DeferrableProvider;

class StreamServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LoopInterface::class, function () {
            return Factory::create();
        });

        $this->app->singleton(WritableStreamInterface::class, function (Application $app) {
            return new WritableResourceStream(STDOUT, $app[LoopInterface::class]);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            LoopInterface::class,
            WritableStreamInterface::class,
        ];
    }
}
