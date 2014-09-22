<?php

namespace SymfonyLive\Attendee;

use SymfonyLive\Conference\Conference;

interface PersonalScheduleRepository
{
    public function findOrCreateConferenceSchedule(Conference $conference);
}
