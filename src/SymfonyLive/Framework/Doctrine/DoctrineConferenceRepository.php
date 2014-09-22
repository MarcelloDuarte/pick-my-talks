<?php

namespace SymfonyLive\Framework\Doctrine;

use Doctrine\ORM\EntityRepository;
use SymfonyLive\Conference\Conference;
use SymfonyLive\Conference\ConferenceRepository;

class DoctrineConferenceRepository extends EntityRepository implements ConferenceRepository
{
    public function saveConference(Conference $conference)
    {
        $this->getEntityManager()->persist($conference);
    }

    public function findConference($name)
    {
        return $this->find($name);
    }
}
