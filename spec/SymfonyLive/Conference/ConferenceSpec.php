<?php

namespace spec\SymfonyLive\Conference;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SymfonyLive\Conference\Slot;
use SymfonyLive\Conference\TalkSchedule;
use SymfonyLive\Conference\Track;
use SymfonyLive\Talk\Talk;

class ConferenceSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('namedWithTracks', ['Symfony Live 2014', 2]);
    }

    function it_allows_to_schedule_the_talk_and_then_provide_a_schedule_for_it()
    {
        $talk = Talk::named('Advanced Symfony');
        $slot = Slot::fromString('09:00-09:45');
        $track = Track::numbered(2);

        $this->scheduleTalk($talk, $slot, $track);

        $this->getTalkSchedule($talk)->shouldBeLike(
            new TalkSchedule($this->getWrappedObject(), $talk, $slot, $track)
        );
    }

    function it_has_a_name()
    {
        $this->getName()->shouldReturn('Symfony Live 2014');
    }
}
