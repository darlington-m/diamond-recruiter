<?php

namespace DiamondRecruiter\RecruiterBundle\Controller;

use DiamondRecruiter\RecruiterBundle\Entity\Submission;
use DiamondRecruiter\RecruiterBundle\Form\SubmissionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SubmissionController extends Controller
{
    public function viewAction(Request $request, $id)
    {
        $em = $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($this->getUser()->getId());
        if (!$this->get('diamond_recruiter_tenant_check')->check($user, $request)) {
            return $this->render('DiamondRecruiterRecruiterBundle:Pages:error.html.twig', [
            ]);
        }

        $submission = $em->getRepository('DiamondRecruiterRecruiterBundle:Submission')->find($id);

        return $this->render('DiamondRecruiterRecruiterBundle:Submission:view.html.twig', [
            'submission' => $submission
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

        $em = $this->getDoctrine()->getManager();

        if ($request->get('search')) {
            $submissions = $em->getRepository('DiamondRecruiterRecruiterBundle:Submission')->getSearch($request->get('search'));
            return $this->render('DiamondRecruiterRecruiterBundle:Submission:view_all.html.twig', [
                'submissions' => $submissions,
                'search' => true
            ]);
        }

        $paginator  = $this->get('knp_paginator');
        $submissions = $paginator->paginate($user->getSubmissions(), $request->query->getInt('page', 1), 12);

        return $this->render('DiamondRecruiterRecruiterBundle:Submission:view_all.html.twig', [
            'submissions' => $submissions
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

        $submission = new Submission();
;
        $form = $this->createForm(SubmissionType::class, $submission,[
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);

        if($form->isValid()) {
            $submission->setDateCreated(new \DateTime());
            $submission->setUser($user);
            $submission->setTenant($user->getTenant());
            $em->persist($submission);
            $em->flush();

            $paginator  = $this->get('knp_paginator');
            $submissions = $paginator->paginate($user->getSubmissions(), $request->query->getInt('page', 1), 12);

            return $this->redirect($this->generateUrl('diamond_submission_view_all', [
                'submissions' => $submissions,
                'tenant' => $user->getTenant()->getName()
            ]));
        }

        return $this->render('DiamondRecruiterRecruiterBundle:Submission:create.html.twig', [
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

        $submission = $em->getRepository('DiamondRecruiterRecruiterBundle:Submission')->find($id);

        $form = $this->createForm(SubmissionType::class, $submission,[
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);
        if($form->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('diamond_submission_view', [
                'id' => $submission->getId(),
                'tenant' => $user->getTenant()->getName()
            ]));
        }

        return $this->render('DiamondRecruiterRecruiterBundle:Submission:edit.html.twig', [
            'form' => $form->createView(),
            'submission' => $submission
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

        $submission = $em->getRepository('DiamondRecruiterRecruiterBundle:Submission')->find($id);

        try {
            $em->remove($submission);
            $em->flush();
        } catch (ForeignKeyConstraintViolationException $exception) {
            $this->addFlash("notification", "Could not delete submission because it has connected entities");
        }

        return $this->redirect($this->generateUrl('diamond_submission_view_all', [
            'tenant' => $user->getTenant()->getName(),
            'contacts' => $user->getSubmissions()
        ]));
    }
}
