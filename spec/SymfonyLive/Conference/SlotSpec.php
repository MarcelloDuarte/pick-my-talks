<?php

namespace spec\SymfonyLive\Conference;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SlotSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('fromString', ['09:00-09:45']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('SymfonyLive\Conference\Slot');
    }
}
