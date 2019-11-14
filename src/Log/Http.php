<?php

namespace Laravie\Stream\Log;

use Laravie\Stream\Logger;
use React\Stream\WritableStreamInterface;

class Http implements Logger
{
    /**
     * The stream writer implementation.
     *
     * @var \React\Stream\WritableStreamInterface
     */
    protected $writer;

    /**
     * Construct a console logger.
     */
    public function __construct(WritableStreamInterface $writer)
    {
        $this->writer = $writer;
    }

    /**
     * Send info message.
     */
    public function info(string $message): void
    {
        $this->writer->write("{$message}\n");
    }

    /**
     * Send warning message.
     */
    public function warn(string $message): void
    {
        $this->info($message);
    }

    /**
     * Send error message.
     */
    public function error(string $message): void
    {
        $this->info($message);
    }
}
