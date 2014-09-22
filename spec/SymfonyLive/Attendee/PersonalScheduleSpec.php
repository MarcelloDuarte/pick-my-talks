<?php

namespace spec\SymfonyLive\Attendee;

use Countable;
use IteratorAggregate;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SymfonyLive\Attendee\SlotIsAlreadyTakenException;
use SymfonyLive\Conference\Conference;
use SymfonyLive\Conference\Slot;
use SymfonyLive\Conference\Track;
use SymfonyLive\Talk\Talk;

class PersonalScheduleSpec extends ObjectBehavior
{
    function let()
    {
        $conference = Conference::namedWithTracks('Symfony Live 2014', 2);
        $conference->scheduleTalk(
            Talk::named('BDD by Example'),
            Slot::fromString('09:00-09:45'),
            Track::numbered(1)
        );
        $conference->scheduleTalk(
            Talk::named('Advanced Symfony'),
            Slot::fromString('09:00-09:45'),
            Track::numbered(2)
        );

        $this->beConstructedThrough('ofConference', [$conference]);
    }

    function it_is_iterator_aggregate()
    {
        $this->shouldHaveType(IteratorAggregate::class);
    }

    function it_is_countable()
    {
        $this->shouldHaveType(Countable::class);
    }

    function it_allows_to_choose_a_talk()
    {
        $theTalk = Talk::named('Advanced Symfony');

        $this->chooseTalk($theTalk);

        $this->shouldHaveChosenTalkForSlot($theTalk, Slot::fromString('09:00-09:45'));
    }

    function it_does_not_allow_to_choose_a_talk_for_already_taken_slot()
    {
        $this->chooseTalk(Talk::named('BDD by Example'));

        $this->shouldThrow(SlotIsAlreadyTakenException::class)->duringChooseTalk(
            Talk::named('Advanced Symfony')
        );
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

    function it_allows_to_iterate_over_scheduled_talks()
    {
        $this->chooseTalk(Talk::named('BDD by Example'));

        $iterator = $this->getIterator();
        $iterator->shouldHaveCount(1);
    }
}
