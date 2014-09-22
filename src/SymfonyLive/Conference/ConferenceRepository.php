<?php

namespace SymfonyLive\Conference;

interface ConferenceRepository
{
    public function saveConference(Conference $conference);
    public function findConference($name);
}
