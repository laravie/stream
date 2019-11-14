<?php

namespace Laravie\Stream\Log;

use Laravie\Stream\Logger;
use React\Stream\WritableStreamInterface;
use JakubOnderka\PhpConsoleColor\ConsoleColor;

class Console implements Logger
{
    /**
     * The stream writer implementation.
     *
     * @var \React\Stream\WritableStreamInterface
     */
    protected $writer;

    /**
     * Console styler.
     *
     * @var \JakubOnderka\PhpConsoleColor\ConsoleColor
     */
    protected $consoleColor;

    /**
     * Construct a console logger.
     */
    public function __construct(WritableStreamInterface $writer, ConsoleColor $consoleColor)
    {
        $this->writer = $writer;
        $this->consoleColor = $consoleColor;
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
        $this->info($this->consoleColor->apply('yellow', $message));
    }

    /**
     * Send error message.
     */
    public function error(string $message): void
    {
        $this->info($this->consoleColor->apply('red', $message));
    }
}
