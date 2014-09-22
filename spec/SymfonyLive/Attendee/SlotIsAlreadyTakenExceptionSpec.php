<?php

namespace spec\SymfonyLive\Attendee;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use RuntimeException;

class SlotIsAlreadyTakenExceptionSpec extends ObjectBehavior
{
    function it_is_runtime_exception()
    {
        $this->shouldHaveType(RuntimeException::class);
    }
}
