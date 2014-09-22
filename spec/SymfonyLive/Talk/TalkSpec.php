<?php

namespace spec\SymfonyLive\Talk;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TalkSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('named', ['Advanced Symfony']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('SymfonyLive\Talk\Talk');
    }
}
