<?php

namespace Laravie\Stream\Tests\Feature;

use React\EventLoop\LoopInterface;
use React\Stream\ThroughStream;
use React\Stream\WritableResourceStream;
use React\Stream\WritableStreamInterface;
use SebastianBergmann\Environment\OperatingSystem;

class StreamServiceProviderTest extends TestCase
{
    /** @test */
    public function it_provides_proper_services()
    {
        $this->assertTrue($this->app->bound(LoopInterface::class));
        $this->assertTrue($this->app->bound(WritableStreamInterface::class));

        $this->assertInstanceOf(LoopInterface::class, $this->app->make(LoopInterface::class));

        $writable = $this->app->make(WritableStreamInterface::class);

        if ((new OperatingSystem())->getFamily() === 'Windows') {
            $this->assertInstanceOf(ThroughStream::class, $writable);
        } else {
            $this->assertInstanceOf(WritableResourceStream::class, $writable);
        }
    }
}
