<?php

namespace DiamondRecruiter\RecruiterBundle\Controller;

use DiamondRecruiter\RecruiterBundle\Entity\Client;
use DiamondRecruiter\RecruiterBundle\Form\ClientType;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends Controller
{
    public function viewAction(Request $request, $id)
    {
        $em = $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($this->getUser()->getId());
        if (!$this->get('diamond_recruiter_tenant_check')->check($user, $request)) {
            return $this->render('DiamondRecruiterRecruiterBundle:Pages:error.html.twig', [
            ]);
        }

        $client = $em->getRepository('DiamondRecruiterRecruiterBundle:Client')->find($id);

        return $this->render('DiamondRecruiterRecruiterBundle:Client:view.html.twig', [
            'client' => $client
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
            $clients = $em->getRepository('DiamondRecruiterRecruiterBundle:Client')->getSearch($request->get('search'));
            return $this->render('DiamondRecruiterRecruiterBundle:Client:view_all.html.twig', [
                'clients' => $clients,
                'search' => true
            ]);
        }

        $paginator  = $this->get('knp_paginator');
        $clients = $paginator->paginate($user->getClients(), $request->query->getInt('page', 1), 12);

        return $this->render('DiamondRecruiterRecruiterBundle:Client:view_all.html.twig', [
            'clients' => $clients
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

        $client = new Client();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ClientType::class, $client,[
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);

        if($form->isValid()) {
            $client->setDateCreated(new \DateTime());
            $client->setTenant($user->getTenant());
            $client->setUser($user);
            $em->persist($client);
            $em->flush();

            return $this->redirect($this->generateUrl('diamond_client_view', [
                'id' => $client->getId(),
                'tenant' => $user->getTenant()->getName()
            ]));
        }

        return $this->render('DiamondRecruiterRecruiterBundle:Client:create.html.twig', [
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

        $client = $em->getRepository('DiamondRecruiterRecruiterBundle:Client')->find($id);

        $form = $this->createForm(ClientType::class, $client,[
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);
        if($form->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('diamond_client_view', [
                'id' => $client->getId(),
                'tenant' => $user->getTenant()->getName()
            ]));
        }

        return $this->render('DiamondRecruiterRecruiterBundle:Client:edit.html.twig', [
            'form' => $form->createView(),
            'client' => $client
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

        $client = $em->getRepository('DiamondRecruiterRecruiterBundle:Client')->find($id);

        try {
            $em->remove($client);
            $em->flush();
        } catch (ForeignKeyConstraintViolationException $exception) {
            $this->addFlash("notification", "Could not delete client because it has connected entities");
        }

        return $this->redirect($this->generateUrl('diamond_client_view_all', [
            'tenant' => $user->getTenant()->getName(),
            'clients' => $user->getClients()
        ]));
    }
}
