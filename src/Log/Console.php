<?php

namespace Laravie\Stream\Log;

use Laravie\Stream\Logger;
use League\CLImate\CLImate;
use League\CLImate\Util\Writer\WriterInterface;
use React\Stream\WritableStreamInterface;

class Console implements Logger, WriterInterface
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
     * @var \League\CLImate\CLImate
     */
    protected $climate;

    /**
     * Construct a console logger.
     */
    public function __construct(WritableStreamInterface $writer, CLImate $climate)
    {
        $this->writer = $writer;
        $this->climate = $climate;

        $climate->output->add('logger', $this);
        $climate->output->defaultTo('logger');
    }

    /**
     * Send info message.
     */
    public function info(string $message): void
    {
        $this->write("{$message}\n");
    }

    /**
     * Send warning message.
     */
    public function warn(string $message): void
    {
        $this->climate->yellow($message);
    }

    /**
     * Send error message.
     */
    public function error(string $message): void
    {
        $this->climate->red($message);
    }

    /**
     * @param  string  $content
     * @return void
     */
    public function write($content)
    {
        $this->writer->write($content);
    }
}
