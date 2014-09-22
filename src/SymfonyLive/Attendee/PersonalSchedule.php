<?php

namespace SymfonyLive\Attendee;

use Countable;
use SymfonyLive\Conference\Conference;
use SymfonyLive\Conference\Slot;
use SymfonyLive\Talk\Talk;

class PersonalSchedule implements Countable
{
    private $conference;
    private $talkSchedules = [];

    public static function ofConference(Conference $conference)
    {
        $personalSchedule = new PersonalSchedule();
        $personalSchedule->conference = $conference;

        return $personalSchedule;
    }

    public function chooseTalk(Talk $talk)
    {
        $this->talkSchedules[] = $this->conference->getTalkSchedule($talk);
    }

    public function count()
    {
        return count($this->talkSchedules);
    }

    public function hasChosenTalkForSlot(Talk $talk, Slot $slot)
    {
        foreach ($this->talkSchedules as $talkSchedule) {
            if ($talkSchedule->isForTalk($talk) && $talkSchedule->isScheduledFor($slot)) {
                return true;
            }
        }

        return false;
    }
}
