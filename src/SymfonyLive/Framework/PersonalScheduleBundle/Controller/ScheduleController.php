<?php

namespace SymfonyLive\Framework\PersonalScheduleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ScheduleController extends Controller
{
    /**
     * @Route("/conferences/{name}")
     * @Template()
     */
    public function conferenceAction($name)
    {
        return [];
    }
}
