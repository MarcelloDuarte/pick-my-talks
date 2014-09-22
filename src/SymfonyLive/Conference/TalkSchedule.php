<?php

namespace SymfonyLive\Conference;

use SymfonyLive\Talk\Talk;

class TalkSchedule
{
    private $conference;
    private $talk;
    private $slot;
    private $track;

    public function __construct(Conference $conference, Talk $talk, Slot $slot, Track $track)
    {
        $this->conference = $conference;
        $this->talk = (string)$talk;
        $this->slot = (string)$slot;
        $this->track = (string)$track;
    }

    public function isForTalk(Talk $talk)
    {
        return $this->talk == $talk;
    }

    public function isScheduledFor(Slot $slot)
    {
        return $this->slot == $slot;
    }

    public function hasSameSlotAs(TalkSchedule $anotherSchedule)
    {
        return $this->slot == $anotherSchedule->slot;
    }

    public function getTalk()
    {
        return Talk::named($this->talk);
    }

    public function __toString()
    {
        return sprintf('%s %s', $this->talk, $this->slot);
    }
}
