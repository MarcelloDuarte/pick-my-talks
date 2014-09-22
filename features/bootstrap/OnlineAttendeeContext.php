<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\RawMinkContext;
use SymfonyLive\Conference\Conference;
use SymfonyLive\Conference\Slot;
use SymfonyLive\Conference\Track;
use SymfonyLive\Talk\Talk;

class OnlineAttendeeContext extends RawMinkContext implements Context, SnippetAcceptingContext
{
    private $conference;

    use AttendeeDictionary;

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
     * @When I choose the :name talk for my personal schedule of this conference
     */
    public function iChooseTheTalkForMyPersonalScheduleOfThisConference($name)
    {
        $this->getSession()->visit('/conferences/' . urlencode($this->conference->getName()));
        $this->assertSession()->elementExists('css', ".talk:contains('$name')");

        $talkElement = $this->getSession()->getPage()->find('css', ".talk:contains('$name')");
        $talkElement->clickLink('Add to my schedule');
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
