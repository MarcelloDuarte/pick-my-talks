<?php

namespace SymfonyLive\Conference;

use SymfonyLive\Talk\Talk;

class Conference
{
    public static function namedWithTracks($name, $tracks)
    {
        $conference = new Conference();

        // TODO: write logic here

        return $conference;
    }

    public function scheduleTalk(Talk $talk, Slot $slot, Track $track)
    {
        // TODO: write logic here
    }
}
