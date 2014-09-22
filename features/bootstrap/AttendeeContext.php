<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use SymfonyLive\Attendee\PersonalSchedule;
use SymfonyLive\Conference\Conference;
use SymfonyLive\Conference\Slot;
use SymfonyLive\Conference\Track;
use SymfonyLive\Talk\Talk;
use PHPUnit_Framework_Assert as assert;

class AttendeeContext implements Context, SnippetAcceptingContext
{
    private $conference;
    private $personalSchedule;

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
     * @Given a conference named :name with :count track(s)
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
        $this->personalSchedule = PersonalSchedule::ofConference($this->conference);
        $this->personalSchedule->chooseTalk($talk);
    }

    /**
     * @Then my personal schedule for this conference should have :count talk
     */
    public function myPersonalScheduleForThisConferenceShouldHaveTalk($count)
    {
        assert::assertCount($count, $this->personalSchedule);
    }

    /**
     * @Then the chosen talk for :slot slot should be the :talk
     */
    public function theChosenTalkForSlotShouldBeThe(Slot $slot, Talk $talk)
    {
        assert::assertTrue($this->personalSchedule->hasChosenTalkForSlot($talk, $slot));
    }
}
