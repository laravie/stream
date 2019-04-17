<?php

namespace Laravie\Stream\Tests\Feature;

use React\EventLoop\LoopInterface;
use React\Stream\WritableStreamInterface;

class StreamServiceProviderTest extends TestCase
{
    /** @test */
    public function it_provides_proper_services()
    {
        $this->assertTrue($this->app->bound(LoopInterface::class));
        $this->assertTrue($this->app->bound(WritableStreamInterface::class));
    }
}
