<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use SymfonyLive\Conference\Conference;

class OnlineAttendeeContext implements Context, SnippetAcceptingContext
{
    use AttendeeDictionary;

    /**
     * @Given a conference named :name with :count track(s)
     */
    public function aConferenceNamedWithTrack($name, $count)
    {
        $aConference = Conference::namedWithTracks($name, $count);
    }

    /**
     * @Given the :arg1 talk is scheduled for :arg2 slot on the conference track :arg3
     */
    public function theTalkIsScheduledForSlotOnTheConferenceTrack($arg1, $arg2, $arg3)
    {
        throw new PendingException();
    }

    /**
     * @When I choose the :arg1 talk for my personal schedule of this conference
     */
    public function iChooseTheTalkForMyPersonalScheduleOfThisConference($arg1)
    {
        throw new PendingException();
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
