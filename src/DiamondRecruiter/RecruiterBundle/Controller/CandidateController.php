<?php

namespace DiamondRecruiter\RecruiterBundle\Controller;

use DiamondRecruiter\RecruiterBundle\Entity\Candidate;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use DiamondRecruiter\RecruiterBundle\Form\CandidateType;

class CandidateController extends Controller
{
    public function viewAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($this->getUser()->getId());
        if (!$this->get('diamond_recruiter_tenant_check')->check($user, $request)) {
            return $this->render('DiamondRecruiterRecruiterBundle:Pages:error.html.twig', [
            ]);
        }

        $candidate = $em->getRepository('DiamondRecruiterRecruiterBundle:Candidate')->find($id);

        return $this->render('DiamondRecruiterRecruiterBundle:Candidate:view.html.twig', [
            'candidate' => $candidate
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
            $candidates = $em->getRepository('DiamondRecruiterRecruiterBundle:Candidate')->getSearch($request->get('search'));
            return $this->render('DiamondRecruiterRecruiterBundle:Candidate:view_all.html.twig', [
                'candidates' => $candidates,
                'search' => true
            ]);
        }

        $paginator  = $this->get('knp_paginator');
        $candidates = $paginator->paginate($user->getCandidates(), $request->query->getInt('page', 1), 12);

        return $this->render('DiamondRecruiterRecruiterBundle:Candidate:view_all.html.twig', [
            'candidates' => $candidates
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

        $candidate = new Candidate();

        $form = $this->createForm(CandidateType::class, $candidate,[
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);

        if($form->isValid()) {

            $file = $candidate->getAvatar();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('image_directory'),
                $fileName
            );
            $candidate->setAvatar($fileName);

            $file = $candidate->getCv();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('file_directory'),
                $fileName
            );
            $candidate->setCv($fileName);

            $candidate->setDateCreated(new \DateTime());
            $candidate->setTenant($user->getTenant());
            $candidate->setUser($user);
            $em->persist($candidate);
            $em->flush();

            return $this->redirect($this->generateUrl('diamond_candidate_view', [
                'id' => $candidate->getId(),
                'tenant' => $user->getTenant()->getName()
            ]));
        }

        return $this->render('DiamondRecruiterRecruiterBundle:Candidate:create.html.twig', [
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

        $em = $this->getDoctrine()->getManager();
        $candidate = $em->getRepository('DiamondRecruiterRecruiterBundle:Candidate')->find($id);

        $form = $this->createForm(CandidateType::class, $candidate,[
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);
        if($form->isValid()) {

            $file = $candidate->getAvatar();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('image_directory'),
                $fileName
            );
            $candidate->setAvatar($fileName);

            $file = $candidate->getCv();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('file_directory'),
                $fileName
            );
            $candidate->setCv($fileName);


            $em->flush();
            return $this->redirect($this->generateUrl('diamond_candidate_view', [
                'tenant' => $user->getTenant()->getName(),
                'id' => $candidate->getId()
            ]));
        }

        return $this->render('DiamondRecruiterRecruiterBundle:Candidate:edit.html.twig', [
            'form' => $form->createView(),
            'candidate' => $candidate
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

        $candidate = $em->getRepository('DiamondRecruiterRecruiterBundle:Candidate')->find($id);

        try {
            $em->remove($candidate);
            $em->flush();
        } catch (ForeignKeyConstraintViolationException $exception) {
            $this->addFlash("notification", "Could not delete candidate because it has connected entities");
        }

        return $this->redirect($this->generateUrl('diamond_candidate_view_all', [
            'tenant' => $user->getTenant()->getName(),
            'candidates' => $user->getCandidates()
        ]));
    }
}
