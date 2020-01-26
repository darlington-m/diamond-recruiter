<?php

namespace DiamondRecruiter\RecruiterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PagesController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($this->getUser()->getId());
        if (!$this->get('diamond_recruiter_tenant_check')->check($user, $request)) {
            return $this->render('DiamondRecruiterRecruiterBundle:Pages:error.html.twig', [
            ]);
        }

        return $this->render('DiamondRecruiterRecruiterBundle:Pages:index.html.twig', [
            'user' => $user
        ]);
    }

    public function initAction(Request $request)
    {
        $em = $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($this->getUser()->getId());
        if ($user->getTenant() == null) {
            return $this->render('DiamondRecruiterRecruiterBundle:Pages:no_tenant_error.html.twig', [
            ]);
        }

        return $this->redirect($this->generateUrl('diamond_index', [
            'tenant' => $user->getTenant()->getName(),
            'user' => $user
        ]));
    }

    public function calendarAction(Request $request)
    {
        $em = $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($this->getUser()->getId());
        if (!$this->get('diamond_recruiter_tenant_check')->check($user, $request)) {
            return $this->render('DiamondRecruiterRecruiterBundle:Pages:error.html.twig', [
            ]);
        }

        return $this->render('DiamondRecruiterRecruiterBundle:Pages:calendar.html.twig', [
        ]);
    }

}
