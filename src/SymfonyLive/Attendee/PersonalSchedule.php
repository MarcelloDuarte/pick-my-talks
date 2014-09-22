<?php

namespace SymfonyLive\Attendee;

use SymfonyLive\Conference\Conference;
use SymfonyLive\Talk\Talk;

class PersonalSchedule
{
    public static function ofConference(Conference $conference)
    {
        $personalSchedule = new PersonalSchedule();

        // TODO: write logic here

        return $personalSchedule;
    }

    public function chooseTalk(Talk $talk)
    {
        // TODO: write logic here
    }
}
