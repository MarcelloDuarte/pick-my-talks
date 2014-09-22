<?php

namespace spec\SymfonyLive\Attendee;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SymfonyLive\Conference\Conference;
use SymfonyLive\Talk\Talk;

class PersonalScheduleSpec extends ObjectBehavior
{
    function let()
    {
        $conference = Conference::namedWithTracks('Symfony Live 2014', 2);

        $this->beConstructedThrough('ofConference', [$conference]);
    }

    function it_allows_to_choose_a_talk()
    {
        $this->chooseTalk(Talk::named('Advanced Symfony'));
    }
}
