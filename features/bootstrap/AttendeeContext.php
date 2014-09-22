<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use SymfonyLive\Conference\Conference;
use SymfonyLive\Conference\Slot;
use SymfonyLive\Conference\Track;
use SymfonyLive\Talk\Talk;

class AttendeeContext implements Context, SnippetAcceptingContext
{
    private $conference;

    /**
     * @Transform :count
     */
    public function transformStringToCount($string)
    {
        return (int)$string;
    }

    /**
     * @Transform :talk
     */
    public function transformStringToTalk($string)
    {
        return Talk::named($string);
    }

    /**
     * @Transform :slot
     */
    public function transformStringToSlot($string)
    {
        return Slot::fromString($string);
    }

    /**
     * @Transform :track
     */
    public function transformStringToTrack($string)
    {
        return Track::numbered((int)$string);
    }

    /**
     * @Given a conference named :name with :count track
     */
    public function aConferenceNamedWithTrack($name, $count)
    {
        $this->conference = Conference::namedWithTracks($name, $count);
    }

    /**
     * @Given the :talk talk is scheduled for :slot slot on the conference track :track
     */
    public function theTalkIsScheduledForSlotOnTheConferenceTrack(Talk $talk, Slot $slot, Track $track)
    {
        $this->conference->scheduleTalk($talk, $slot, $track);
    }

    /**
     * @When I choose the :talk talk for my personal schedule of this conference
     */
    public function iChooseTheTalkForMyPersonalScheduleOfThisConference(Talk $talk)
    {
        $myPersonalSchedule = PersonalSchedule::ofConference($this->conference);
        $myPersonalSchedule->chooseTalk($talk);
    }

    /**
     * @Then my personal schedule for this conference should have :arg1 talk
     */
    public function myPersonalScheduleForThisConferenceShouldHaveTalk($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the chosen talk for :arg1 slot should be the :arg2
     */
    public function theChosenTalkForSlotShouldBeThe($arg1, $arg2)
    {
        throw new PendingException();
    }
}
