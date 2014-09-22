<?php

namespace SymfonyLive\Framework\PersonalScheduleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SymfonyLive\Conference\Conference;

class ScheduleController extends Controller
{
    /**
     * @Route("/conferences/{conferenceName}", name="conference")
     * @Template()
     */
    public function conferenceAction($conferenceName)
    {
        $conference = $this->getConferenceByNameOr404(urldecode($conferenceName));
        $mySchedule = $this->getConferenceSchedule($conference);

        return ['conference' => $conference, 'mySchedule' => $mySchedule];
    }

    /**
     * @Route("/conferences/{conferenceName}/talks/{talkName}/choose", name="choose_talk")
     * @Template()
     */
    public function chooseTalkAction(Request $request, $conferenceName, $talkName)
    {
        return $this->redirect($request->headers->get('referer'));
    }

    private function getConferenceByNameOr404($name)
    {
        $conference = $this->get('symfony_live.conference_repository')->findConference($name);

        if (!$conference) {
            throw $this->createNotFoundException();
        }

        return $conference;
    }

    private function getConferenceSchedule(Conference $conference)
    {
        return $this->get('symfony_live.personal_schedule_repository')
            ->findOrCreateConferenceSchedule($conference);
    }
}
