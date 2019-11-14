<?php

namespace Laravie\Stream\Laravel;

use React\EventLoop\Factory;
use React\Stream\ThroughStream;
use React\EventLoop\LoopInterface;
use Illuminate\Support\ServiceProvider;
use React\Stream\WritableResourceStream;
use React\Stream\WritableStreamInterface;
use Illuminate\Contracts\Container\Container;
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
        $this->app->singleton(LoopInterface::class, static function () {
            return Factory::create();
        });

        $this->app->singleton(WritableStreamInterface::class, function (Container $app) {
            return $this->createOutputStream($app->make(LoopInterface::class));
        });
    }

    /**
     * Get an output stream.
     */
    protected function createOutputStream(LoopInterface $eventLoop): WritableStreamInterface
    {
        if (\defined('STDOUT')) {
            return new WritableResourceStream(STDOUT, $eventLoop);
        }

        return new ThroughStream(static function ($data) {
            echo "{$data}\n";
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
