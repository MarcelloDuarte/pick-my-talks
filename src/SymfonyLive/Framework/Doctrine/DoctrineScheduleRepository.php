<?php

namespace SymfonyLive\Framework\Doctrine;

use Doctrine\ORM\EntityRepository;
use SymfonyLive\Attendee\PersonalSchedule;
use SymfonyLive\Attendee\PersonalScheduleRepository;
use SymfonyLive\Conference\Conference;

class DoctrineScheduleRepository extends EntityRepository implements PersonalScheduleRepository
{
    public function findOrCreateConferenceSchedule(Conference $conference)
    {
        $schedule = $this->findOneBy(['conference' => $conference]);

        if (!$schedule) {
            $schedule = PersonalSchedule::ofConference($conference);
            $this->getEntityManager()->persist($schedule);
        }

        return $schedule;
    }
}
