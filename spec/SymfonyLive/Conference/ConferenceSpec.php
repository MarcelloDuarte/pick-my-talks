<?php

namespace spec\SymfonyLive\Conference;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SymfonyLive\Conference\Slot;
use SymfonyLive\Conference\Track;
use SymfonyLive\Talk\Talk;

class ConferenceSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('namedWithTracks', ['Symfony Live 2014', 2]);
    }

    function it_allows_to_schedule_the_talk()
    {
        $talk = Talk::named('Advanced Symfony');
        $slot = Slot::fromString('09:00-09:45');
        $track = Track::numbered(2);

        $this->scheduleTalk($talk, $slot, $track);
    }
}
