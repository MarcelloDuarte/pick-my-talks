<?php

namespace SymfonyLive\Talk;

class Talk
{
    private $name;

    public static function named($name)
    {
        $talk = new Talk();
        $talk->name = $name;

        return $talk;
    }

    public function __toString()
    {
        return $this->name;
    }
}
