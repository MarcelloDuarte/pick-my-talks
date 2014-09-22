<?php

namespace SymfonyLive\Conference;

class Slot
{
    private $string;

    public static function fromString($string)
    {
        $slot = new Slot();
        $slot->string = $string;

        return $slot;
    }

    public function __toString()
    {
        return $this->string;
    }
}
