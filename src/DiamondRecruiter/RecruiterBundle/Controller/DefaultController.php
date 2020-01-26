<?php

namespace DiamondRecruiter\RecruiterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($tenant)
    {
        return $this->render('DiamondRecruiterRecruiterBundle:Default:index.html.twig', [
            'tenant' => $tenant
        ]);
    }
}
