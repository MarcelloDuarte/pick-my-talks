<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\RawMinkContext;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use SymfonyLive\Conference\Conference;
use SymfonyLive\Conference\ConferenceRepository;
use SymfonyLive\Conference\Slot;
use SymfonyLive\Conference\Track;
use SymfonyLive\Talk\Talk;

class OnlineAttendeeContext extends RawMinkContext implements Context, SnippetAcceptingContext
{
    private $repository;
    private $em;
    private $conference;

    use AttendeeDictionary;

    public function __construct(ConferenceRepository $repository, EntityManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @BeforeScenario
     */
    public function cleanDatabase()
    {
        $metadata = $this->em->getMetadataFactory()->getAllMetadata();
        if (!empty($metadata)) {
            $tool = new SchemaTool($this->em);
            $tool->dropSchema($metadata);
            $tool->createSchema($metadata);
        }
    }

    /**
     * @Given a conference named :name with :count track(s)
     */
    public function aConferenceNamedWithTrack($name, $count)
    {
        $this->conference = Conference::namedWithTracks($name, $count);
        $this->repository->saveConference($this->conference);
        $this->em->flush();
    }

    /**
     * @Given the :talk talk is scheduled for :slot slot on the conference track :track
     */
    public function theTalkIsScheduledForSlotOnTheConferenceTrack(Talk $talk, Slot $slot, Track $track)
    {
        $this->conference->scheduleTalk($talk, $slot, $track);
        $this->em->flush();
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
     * @Then my personal schedule for this conference should have :count talk
     */
    public function myPersonalScheduleForThisConferenceShouldHaveTalk($count)
    {
        $this->assertSession()->elementsCount('css', '.my-schedule .talk', $count);
    }

    /**
     * @Then the chosen talk for :time slot should be the :name
     */
    public function theChosenTalkForSlotShouldBeThe($time, $name)
    {
        $this->assertSession()->elementTextContains('css',  ".my-schedule .talk:contains('$name')",  $time);
    }
}
