<?php

namespace SymfonyLive\Framework\PersonalScheduleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ScheduleController extends Controller
{
    /**
     * @Route("/conferences/{conferenceName}", name="conference")
     * @Template()
     */
    public function conferenceAction($conferenceName)
    {
        $conference = $this->getConferenceByNameOr404($conferenceName);

        return ['conference' => $conference];
    }

    /**
     * @Route("/conferences/{conferenceName}/talks/{talkName}/choose", name="choose_talk")
     * @Template()
     */
    public function chooseTalkAction(Request $request, $conferenceName, $talkName)
    {
        $conference = $this->getConferenceByNameOr404($conferenceName);

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @param $conferenceName
     *
     * @return mixed
     */
    private function getConferenceByNameOr404($conferenceName)
    {
        $conferenceName = urldecode($conferenceName);
        $conference = $this->get('symfony_live.conference_repository')->findConference(
            $conferenceName
        );

        if (!$conference) {
            throw $this->createNotFoundException();
        }

        return $conference;
    }
}
