<?php

namespace spec\SymfonyLive\Attendee;

use Countable;
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

    function it_is_countable()
    {
        $this->shouldHaveType(Countable::class);
    }

    function it_allows_to_choose_a_talk()
    {
        $this->chooseTalk(Talk::named('Advanced Symfony'));
    }

    function it_has_zero_count_from_the_start()
    {
        $this->count()->shouldReturn(0);
    }

    function it_counts_chosen_talks()
    {
        $this->chooseTalk(Talk::named('BDD by Example'));

        $this->count()->shouldReturn(1);
    }
}
