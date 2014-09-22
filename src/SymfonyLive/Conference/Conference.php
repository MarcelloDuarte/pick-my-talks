<?php

namespace SymfonyLive\Conference;

use SymfonyLive\Talk\Talk;

class Conference
{
    private $talkSchedules = [];

    public static function namedWithTracks($name, $tracks)
    {
        $conference = new Conference();

        // TODO: write logic here

        return $conference;
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
}
