<?php

namespace DiamondRecruiter\RecruiterBundle\Controller;

use DiamondRecruiter\RecruiterBundle\Entity\Placement;
use DiamondRecruiter\RecruiterBundle\Form\PlacementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PlacementController extends Controller
{
    public function viewAction(Request $request, $id)
    {
        $em = $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($this->getUser()->getId());
        if (!$this->get('diamond_recruiter_tenant_check')->check($user, $request)) {
            return $this->render('DiamondRecruiterRecruiterBundle:Pages:error.html.twig', [
            ]);
        }

        $placement = $em->getRepository('DiamondRecruiterRecruiterBundle:Placement')->find($id);

        return $this->render('DiamondRecruiterRecruiterBundle:Placement:view.html.twig', [
            'placement' => $placement
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
            $placements = $em->getRepository('DiamondRecruiterRecruiterBundle:Placement')->getSearch($request->get('search'));
            return $this->render('DiamondRecruiterRecruiterBundle:Placement:view_all.html.twig', [
                'placements' => $placements,
                'search' => true
            ]);
        }

        $paginator  = $this->get('knp_paginator');
        $placements = $paginator->paginate($user->getPlacements(), $request->query->getInt('page', 1), 12);

        return $this->render('DiamondRecruiterRecruiterBundle:Placement:view_all.html.twig', [
            'placements' => $placements
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

        $placement = new Placement();

        $form = $this->createForm(PlacementType::class, $placement,[
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);

        if($form->isValid()) {
            $placement->setDateCreated(new \DateTime());
            $placement->setTenant($user->getTenant());
            $placement->setUser($user);
            $sub = $em->getRepository('DiamondRecruiterRecruiterBundle:Submission')->find($placement->getSubmission()->getId());
            $placement->setClient($sub->getClient());
            $placement->setCandidate($sub->getCandidate());
            $placement->setVacancy($sub->getVacancy());
            $em->persist($placement);
            $em->flush();

            $paginator  = $this->get('knp_paginator');
            $placements = $paginator->paginate($user->getPlacements(), $request->query->getInt('page', 1), 12);

            return $this->redirect($this->generateUrl('diamond_placement_view_all', [
                'placements' => $placements,
                'tenant' => $user->getTenant()->getName()
            ]));
        }

        return $this->render('DiamondRecruiterRecruiterBundle:Placement:create.html.twig', [
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
        };

        $placement = $em->getRepository('DiamondRecruiterRecruiterBundle:Placement')->find($id);

        $form = $this->createForm(PlacementType::class, $placement,[
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);
        if($form->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('diamond_placement_view', [
                'id' => $placement->getId(),
                'tenant' => $user->getTenant()->getName()
            ]));
        }

        return $this->render('DiamondRecruiterRecruiterBundle:Placement:edit.html.twig', [
            'form' => $form->createView(),
            'placement' => $placement
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

        $placement = $em->getRepository('DiamondRecruiterRecruiterBundle:Placement')->find($id);
        $em->remove($placement);

        try {
            $em->remove($placement);
            $em->flush();
        } catch (ForeignKeyConstraintViolationException $exception) {
            $this->addFlash("notification", "Could not delete placement because it has connected entities");
        }

        return $this->redirect($this->generateUrl('diamond_placement_view_all', [
            'tenant' => $user->getTenant()->getName(),
            'placements' => $user->getPlacements()
        ]));
    }
}
