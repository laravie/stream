<?php

namespace Laravie\Stream;

abstract class Logger
{
    /**
     * Send info message.
     *
     * @param  string $message
     *
     * @return void
     */
    public function info(string $message): void;

    /**
     * Send warning message.
     *
     * @param  string $message
     *
     * @return void
     */
    public function warn(string $message): void;

    /**
     * Send error message.
     *
     * @param  string $message
     *
     * @return void
     */
    public function error(string $message): void;
}
