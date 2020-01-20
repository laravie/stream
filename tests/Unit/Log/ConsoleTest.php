<?php

namespace Laravie\Stream\Tests\Unit\Log;

use JakubOnderka\PhpConsoleColor\ConsoleColor;
use Laravie\Stream\Log\Console;
use Laravie\Stream\Logger;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use React\Stream\WritableStreamInterface;

class ConsoleTest extends TestCase
{
    /**
     * Teardown the test environment.
     */
    protected function tearDown(): void
    {
        m::close();
    }

    /** @test */
    public function it_has_proper_signature()
    {
        $writer = m::mock(WritableStreamInterface::class);
        $styler = new ConsoleColor();

        $stub = new Console($writer, $styler);

        $this->assertInstanceOf(Logger::class, $stub);
    }

    /** @test */
    public function it_can_write_info()
    {
        $writer = m::mock(WritableStreamInterface::class);
        $styler = new ConsoleColor();

        $stub = new Console($writer, $styler);

        $writer->shouldReceive('write')->once()->with("Hello world\n")->andReturnNull();

        $stub->info('Hello world');

        $this->addToAssertionCount(1);
    }

    /** @test */
    public function it_can_write_warn()
    {
        $writer = m::mock(WritableStreamInterface::class);
        $styler = new ConsoleColor();

        $stub = new Console($writer, $styler);

        $writer->shouldReceive('write')->once()->with("\033[33mHello world\033[0m\n")->andReturnNull();

        $stub->warn('Hello world');

        $this->addToAssertionCount(1);
    }

    /** @test */
    public function it_can_write_error()
    {
        $writer = m::mock(WritableStreamInterface::class);
        $styler = new ConsoleColor();

        $stub = new Console($writer, $styler);

        $writer->shouldReceive('write')->once()->with("\033[31mHello world\033[0m\n")->andReturnNull();

        $stub->error('Hello world');

        $this->addToAssertionCount(1);
    }
}
