<?php

namespace SymfonyLive\Attendee;

use Countable;
use Doctrine\Common\Collections\ArrayCollection;
use IteratorAggregate;
use SymfonyLive\Conference\Conference;
use SymfonyLive\Conference\Slot;
use SymfonyLive\Talk\Talk;

class PersonalSchedule implements Countable, IteratorAggregate
{
    private $conference;
    private $talkSchedules;

    public static function ofConference(Conference $conference)
    {
        $personalSchedule = new PersonalSchedule();
        $personalSchedule->conference = $conference;
        $personalSchedule->talkSchedules = new ArrayCollection();

        return $personalSchedule;
    }

    public function chooseTalk(Talk $talk)
    {
        $schedule = $this->conference->getTalkSchedule($talk);

        foreach ($this->talkSchedules as $chosenSchedule) {
            if ($chosenSchedule->hasSameSlotAs($schedule)) {
                throw new SlotIsAlreadyTakenException;
            }
        }

        $this->talkSchedules[] = $schedule;
    }

    public function count()
    {
        return count($this->talkSchedules);
    }

    public function hasChosenTalkForSlot(Talk $talk, Slot $slot)
    {
        foreach ($this->talkSchedules as $chosenSchedule) {
            if ($chosenSchedule->isForTalk($talk) && $chosenSchedule->isScheduledFor($slot)) {
                return true;
            }
        }

        return false;
    }

    public function getIterator()
    {
        return $this->talkSchedules;
    }
}
