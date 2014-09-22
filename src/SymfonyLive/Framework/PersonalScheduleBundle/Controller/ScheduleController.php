<?php

namespace SymfonyLive\Framework\PersonalScheduleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SymfonyLive\Conference\Conference;
use SymfonyLive\Talk\Talk;

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
        $conference = $this->getConferenceByNameOr404(urldecode($conferenceName));
        $mySchedule = $this->getConferenceSchedule($conference);
        $talk = Talk::named(urldecode($talkName));

        $mySchedule->chooseTalk($talk);
        $this->get('doctrine.orm.entity_manager')->flush();

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
        return $this->get('symfony_live.schedule_repository')->findOrCreateConferenceSchedule($conference);
    }
}
