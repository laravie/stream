<?php

namespace Laravie\Stream;

interface Logger
{
    /**
     * Send info message.
     */
    public function info(string $message): void;

    /**
     * Send warning message.
     */
    public function warn(string $message): void;

    /**
     * Send error message.
     */
    public function error(string $message): void;
}
