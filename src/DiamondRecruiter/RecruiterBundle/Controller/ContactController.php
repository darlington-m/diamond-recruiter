<?php

namespace DiamondRecruiter\RecruiterBundle\Controller;

use DiamondRecruiter\RecruiterBundle\Entity\Contact;
use DiamondRecruiter\RecruiterBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function viewAction(Request $request, $id)
    {
        $em = $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($this->getUser()->getId());
        if (!$this->get('diamond_recruiter_tenant_check')->check($user, $request)) {
            return $this->render('DiamondRecruiterRecruiterBundle:Pages:error.html.twig', [
            ]);
        }

        $contact = $em->getRepository('DiamondRecruiterRecruiterBundle:Contact')->find($id);

        return $this->render('DiamondRecruiterRecruiterBundle:Contact:view.html.twig', [
            'contact' => $contact
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
            $contacts = $em->getRepository('DiamondRecruiterRecruiterBundle:Contact')->getSearch($request->get('search'));
            return $this->render('DiamondRecruiterRecruiterBundle:Contact:view_all.html.twig', [
                'vacancies' => $contacts,
                'search' => true
            ]);
        }

        $paginator  = $this->get('knp_paginator');
        $contacts = $paginator->paginate($user->getContacts(), $request->query->getInt('page', 1), 12);

        return $this->render('DiamondRecruiterRecruiterBundle:Contact:view_all.html.twig', [
            'contacts' => $contacts
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

        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact,[
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);

        if($form->isValid()) {
            if ($contact->getAvatar()) {
                $file = $contact->getAvatar();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('image_directory'),
                    $fileName
                );
                $contact->setAvatar($fileName);
            } else {
                $contact->setAvatar('placeholder.png');
            }

            $contact->setDateCreated(new \DateTime());
            $contact->setTenant($user->getTenant());
            $contact->setUser($user);
            $em->persist($contact);
            $em->flush();

            return $this->redirect($this->generateUrl('diamond_contact_view', [
                'id' => $contact->getId(),
                'tenant' => $user->getTenant()->getName()
            ]));
        }

        return $this->render('DiamondRecruiterRecruiterBundle:Contact:create.html.twig', [
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

        $contact = $em->getRepository('DiamondRecruiterRecruiterBundle:Contact')->find($id);

        $form = $this->createForm(ContactType::class, $contact,[
            'action' => $request->getUri(),
            'tenant' => $user->getTenant()->getName()
        ]);

        $form->handleRequest($request);
        if($form->isValid()) {
            if($contact->getAvatar()) {
                $file = $contact->getAvatar();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('image_directory'),
                    $fileName
                );
                $contact->setAvatar($fileName);
            }

            $em->flush();
            return $this->redirect($this->generateUrl('diamond_contact_view', [
                'id' => $contact->getId()
            ]));
        }

        return $this->render('DiamondRecruiterRecruiterBundle:Contact:edit.html.twig', [
            'form' => $form->createView(),
            'contact' => $contact
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

        $contact = $em->getRepository('DiamondRecruiterRecruiterBundle:Contact')->find($id);

        try {
            $em->remove($contact);
            $em->flush();
        } catch (ForeignKeyConstraintViolationException $exception) {
            $this->addFlash("notification", "Could not delete contact because it has connected entities");
        }

        return $this->redirect($this->generateUrl('diamond_contact_view_all', [
            'tenant' => $user->getTenant()->getName(),
            'contacts' => $user->getContacts()
        ]));
    }
}
