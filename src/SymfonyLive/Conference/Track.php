<?php

namespace SymfonyLive\Conference;

class Track
{
    private $number;

    public static function numbered($number)
    {
        $track = new Track();
        $track->number = $number;

        return $track;
    }

    public function __toString()
    {
        return (string)$this->number;
    }
}
