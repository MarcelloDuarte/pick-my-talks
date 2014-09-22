<?php

use SymfonyLive\Conference\Slot;
use SymfonyLive\Conference\Track;
use SymfonyLive\Talk\Talk;

trait AttendeeDictionary
{
    /**
     * @Transform :count
     */
    public function transformStringToCount($string)
    {
        return (int)$string;
    }

    /**
     * @Transform :talk
     */
    public function transformStringToTalk($string)
    {
        return Talk::named($string);
    }

    /**
     * @Transform :slot
     */
    public function transformStringToSlot($string)
    {
        return Slot::fromString($string);
    }

    /**
     * @Transform :track
     */
    public function transformStringToTrack($string)
    {
        return Track::numbered((int)$string);
    }
}
