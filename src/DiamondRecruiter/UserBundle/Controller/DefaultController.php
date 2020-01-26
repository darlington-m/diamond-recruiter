<?php

namespace DiamondRecruiter\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DiamondRecruiterUserBundle:Default:index.html.twig');
    }
}
