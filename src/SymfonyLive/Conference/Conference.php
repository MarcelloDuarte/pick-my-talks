<?php

namespace SymfonyLive\Conference;

use ArrayIterator;
use Doctrine\Common\Collections\ArrayCollection;
use IteratorAggregate;
use SymfonyLive\Talk\Talk;

class Conference implements IteratorAggregate
{
    private $name;
    private $talkSchedules;

    public static function namedWithTracks($name, $tracks)
    {
        $conference = new Conference();
        $conference->name = $name;
        $conference->talkSchedules = new ArrayCollection();

        return $conference;
    }

    public function getName()
    {
        return $this->name;
    }

    public function scheduleTalk(Talk $talk, Slot $slot, Track $track)
    {
        $this->talkSchedules[] = new TalkSchedule($this, $talk, $slot, $track);
    }

    public function getTalkSchedule(Talk $talk)
    {
        foreach ($this->talkSchedules as $talkSchedule) {
            if ($talkSchedule->isForTalk($talk)) {
                return $talkSchedule;
            }
        }
    }

    public function getIterator()
    {
        return $this->talkSchedules;
    }
}
