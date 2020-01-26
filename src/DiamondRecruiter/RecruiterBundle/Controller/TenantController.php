<?php

namespace DiamondRecruiter\RecruiterBundle\Controller;

use DiamondRecruiter\RecruiterBundle\DiamondRecruiterRecruiterBundle;
use DiamondRecruiter\UserBundle\Entity\User;
use Doctrine\DBAL\Driver\PDOException;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DiamondRecruiter\RecruiterBundle\Entity\Tenant;
use DiamondRecruiter\RecruiterBundle\Form\TenantType;

class TenantController extends Controller
{
    public function viewAction(Request $request, $id)
    {
        $em = $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($this->getUser()->getId());
        if (!$this->get('diamond_recruiter_tenant_check')->check($user, $request)) {
            return $this->render('DiamondRecruiterRecruiterBundle:Pages:error.html.twig', [
            ]);
        }

        $tenant = $em->getRepository('DiamondRecruiterRecruiterBundle:Tenant')->find($id);

        return $this->render('DiamondRecruiterRecruiterBundle:Tenant:view.html.twig', [
            'tenant' => $tenant,
            'users' => $tenant->getUsers()
        ]);
    }

    public function viewAllAction(Request $request)
    {
        $em = $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($this->getUser()->getId());
        if (!$this->get('diamond_recruiter_tenant_check')->check($user, $request)) {
            return $this->render('DiamondRecruiterRecruiterBundle:Pages:error.html.twig', [
            ]);
        }

        if ($request->get('search')) {
            $tenants = $em->getRepository('DiamondRecruiterRecruiterBundle:Tenant')->getSearch($request->get('search'));
            return $this->render('DiamondRecruiterRecruiterBundle:Tenant:view_all.html.twig', [
                'tenants' => $tenants,
                'search' => true
            ]);
        }

        $tens = $em->getRepository('DiamondRecruiterRecruiterBundle:Tenant')->findAll();
        $paginator  = $this->get('knp_paginator');
        $tenants = $paginator->paginate($tens, $request->query->getInt('page', 1), 20);

        return $this->render('DiamondRecruiterRecruiterBundle:Tenant:view_all.html.twig', [
            'tenants' => $tenants
        ]);
    }

    public function createAction(Request $request)
    {
        $em = $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($this->getUser()->getId());
        if (!$this->get('diamond_recruiter_tenant_check')->check($user, $request)) {
            return $this->render('DiamondRecruiterRecruiterBundle:Pages:error.html.twig', [
            ]);
        }

        $_tenant = new Tenant();

        $form = $this->createForm(TenantType::class, $_tenant,[
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);
        if($form->isValid()) {
            $_tenant->setTimestamp(new \DateTime());


            try {
                $em->persist($_tenant);
                $em->flush();
            } catch (UniqueConstraintViolationException $exception ) {
                $this->addFlash("notification", "Error! Tenant with name \"" . $_tenant->getName() .  "\" already exists");
            }

            $tens = $em->getRepository('DiamondRecruiterRecruiterBundle:Tenant')->findAll();
            $paginator  = $this->get('knp_paginator');
            $tenants = $paginator->paginate($tens, $request->query->getInt('page', 1), 20);

            return $this->redirect($this->generateUrl('diamond_tenant_view_all', [
                'tenant' => $user->getTenant()->getName(),
                'tenants' => $tenants
            ]));
        }

        return $this->render('DiamondRecruiterRecruiterBundle:Tenant:create.html.twig', [
            'form' => $form->createView()
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

        $tenant = $em->getRepository('DiamondRecruiterRecruiterBundle:Tenant')->find($id);

        $form = $this->createForm(TenantType::class, $tenant,[
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);
        if($form->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('diamond_tenant_view', [
                'id' => $tenant->getId(),
                'tenant' => $tenant
            ]));
        }

        return $this->render('DiamondRecruiterRecruiterBundle:Tenant:edit.html.twig', [
            'form' => $form->createView(),
            'tenant' => $tenant
        ]);

    }

    public function deleteAction(Request $request, $id)
    {
        $em = $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($this->getUser()->getId());
        if (!$this->get('diamond_recruiter_tenant_check')->check($user, $request)) {
            return $this->render('DiamondRecruiterRecruiterBundle:Pages:error.html.twig', [
            ]);
        }

        $_tenant = $em->getRepository('DiamondRecruiterRecruiterBundle:Tenant')->find($id);

        try {
            $em->remove($_tenant);
            $em->flush();
        } catch (ForeignKeyConstraintViolationException $exception) {
            $this->addFlash("notification", "Could not delete tenant because it has connected entities");
        } catch (PDOException  $exception) {
            $this->addFlash("notification", "Could not delete tenant because it has connected entities");
        }

        $tens = $em->getRepository('DiamondRecruiterRecruiterBundle:Tenant')->findAll();
        $paginator  = $this->get('knp_paginator');
        $tenants = $paginator->paginate($tens, $request->query->getInt('page', 1), 20);

        return $this->redirect($this->generateUrl('diamond_tenant_view_all', [
            'tenant' => $user->getTenant()->getName(),
            'tenants' => $tenants
        ]));
    }
}
