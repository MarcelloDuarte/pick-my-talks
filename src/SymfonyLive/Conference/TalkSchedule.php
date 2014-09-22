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
        $this->talk = $talk;
        $this->slot = $slot;
        $this->track = $track;
    }

    public function isForTalk(Talk $talk)
    {
        return $this->talk == $talk;
    }

    public function isScheduledFor(Slot $slot)
    {
        return $this->slot == $slot;
    }
}
