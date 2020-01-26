<?php

namespace DiamondRecruiter\RecruiterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DiamondRecruiter\UserBundle\Entity\User;
use DiamondRecruiter\UserBundle\Form\UserType;

class UserController extends Controller
{

    public function viewAllAction(Request $request)
    {
        $em = $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($this->getUser()->getId());
        if (!$this->get('diamond_recruiter_tenant_check')->check($user, $request)) {
            return $this->render('DiamondRecruiterRecruiterBundle:Pages:error.html.twig', [
            ]);
        }

        $no_ten_users = $em->getRepository('DiamondRecruiterUserBundle:User')->getNotTenanted();
        if ($request->get('search')) {
            $users = $em->getRepository('DiamondRecruiterUserBundle:User')->getSearch($request->get('search'));
            return $this->render('DiamondRecruiterRecruiterBundle:User:view_all.html.twig', [
                'users' => $users,
                'search' => true

            ]);
        }

        $users = $em->getRepository('DiamondRecruiterUserBundle:User')->findAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate($users, $request->query->getInt('page', 1), 10);

        return $this->render('DiamondRecruiterRecruiterBundle:User:view_all.html.twig', [
            'pagination' => $pagination,
            'users' => $no_ten_users
        ]);
    }

    public function editAction(Request $request, $id)
    {
        $em = $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($this->getUser()->getId());
        if (!$this->get('diamond_recruiter_tenant_check')->check($user, $request)) {
            return $this->render('DiamondRecruiterRecruiterBundle:Pages:error.html.twig', [
            ]);
        }

        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($id);

        $form = $this->createForm(UserType::class, $user,[
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);
        if($form->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('diamond_user_view_all', [
                'tenant' => $this->getUser()->getTenant()->getName()
            ]));
        }
        return $this->render('DiamondRecruiterRecruiterBundle:User:edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
