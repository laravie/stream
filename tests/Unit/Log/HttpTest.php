<?php

namespace Laravie\Stream\Tests\Unit\Log;

use Laravie\Stream\Log\Http;
use Laravie\Stream\Logger;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use React\Stream\WritableStreamInterface;

class HttpTest extends TestCase
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

        $stub = new Http($writer);

        $this->assertInstanceOf(Logger::class, $stub);
    }

    /** @test */
    public function it_can_write_info()
    {
        $writer = m::mock(WritableStreamInterface::class);

        $stub = new Http($writer);

        $writer->shouldReceive('write')->once()->with("Hello world\n")->andReturnNull();

        $stub->info('Hello world');

        $this->addToAssertionCount(1);
    }

    /** @test */
    public function it_can_write_warn()
    {
        $writer = m::mock(WritableStreamInterface::class);

        $stub = new Http($writer);

        $writer->shouldReceive('write')->once()->with("Hello world\n")->andReturnNull();

        $stub->warn('Hello world');

        $this->addToAssertionCount(1);
    }

    /** @test */
    public function it_can_write_error()
    {
        $writer = m::mock(WritableStreamInterface::class);

        $stub = new Http($writer);

        $writer->shouldReceive('write')->once()->with("Hello world\n")->andReturnNull();

        $stub->error('Hello world');

        $this->addToAssertionCount(1);
    }
}
