<?php

namespace Laravie\Stream\Laravel;

use Illuminate\Support\ServiceProvider;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use React\Stream\ThroughStream;
use React\Stream\WritableResourceStream;
use React\Stream\WritableStreamInterface;

class StreamServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LoopInterface::class, static function () {
            return Factory::create();
        });

        $this->app->bind(WritableStreamInterface::class, function () {
            return $this->createOutputStream();
        });
    }

    /**
     * Get an output stream.
     */
    protected function createOutputStream(): WritableStreamInterface
    {
        if (\defined('STDOUT') && DIRECTORY_SEPARATOR === '/') {
            return new WritableResourceStream(STDOUT, app(LoopInterface::class));
        }

        return new ThroughStream(static function ($data) {
            echo "{$data}\n";
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, class-string>
     */
    public function provides()
    {
        return [
            LoopInterface::class,
            WritableStreamInterface::class,
        ];
    }

    /**
     * Determine if the provider is deferred.
     *
     * @return bool
     */
    public function isDeferred()
    {
        return true;
    }
}
