<?php

namespace spec\SymfonyLive\Conference;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConferenceSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('namedWithTracks', ['Symfony Live 2014', 2]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('SymfonyLive\Conference\Conference');
    }
}
