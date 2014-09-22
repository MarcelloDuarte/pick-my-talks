<?php

namespace spec\SymfonyLive\Conference;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SymfonyLive\Conference\Conference;
use SymfonyLive\Conference\Slot;
use SymfonyLive\Conference\Track;
use SymfonyLive\Talk\Talk;

class TalkScheduleSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            Conference::namedWithTracks('Symfony Live 2014', 2),
            Talk::named('BDD by Example'),
            Slot::fromString('09:00-09:45'),
            Track::numbered(2)
        );
    }

    function it_can_say_if_it_is_for_provided_talk()
    {
        $this->shouldBeForTalk(Talk::named('BDD by Example'));
        $this->shouldNotBeForTalk(Talk::named('Symfony by Example'));
    }

    function it_can_say_if_it_is_scheduled_for_provided_slot()
    {
        $this->shouldBeScheduledFor(Slot::fromString('09:00-09:45'));
        $this->shouldNotBeScheduledFor(Slot::fromString('09:45-10:00'));
    }
}
