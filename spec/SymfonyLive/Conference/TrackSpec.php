<?php

namespace spec\SymfonyLive\Conference;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TrackSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('numbered', [1]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('SymfonyLive\Conference\Track');
    }
}
