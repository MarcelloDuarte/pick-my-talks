<?php

namespace SymfonyLive\Attendee;

use Countable;
use SymfonyLive\Conference\Conference;
use SymfonyLive\Talk\Talk;

class PersonalSchedule implements Countable
{
    private $count = 0;

    public static function ofConference(Conference $conference)
    {
        $personalSchedule = new PersonalSchedule();

        // TODO: write logic here

        return $personalSchedule;
    }

    public function chooseTalk(Talk $talk)
    {
        $this->count++;
    }

    public function count()
    {
        return $this->count;
    }
}
