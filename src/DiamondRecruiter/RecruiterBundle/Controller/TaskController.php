<?php

namespace DiamondRecruiter\RecruiterBundle\Controller;

use DiamondRecruiter\RecruiterBundle\Entity\Task;
use DiamondRecruiter\RecruiterBundle\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller
{
    public function viewAction(Request $request, $id)
    {
        $em = $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($this->getUser()->getId());
        if (!$this->get('diamond_recruiter_tenant_check')->check($user, $request)) {
            return $this->render('DiamondRecruiterRecruiterBundle:Pages:error.html.twig', [
            ]);
        }

        $task = $em->getRepository('DiamondRecruiterRecruiterBundle:Task')->find($id);

        return $this->render('DiamondRecruiterRecruiterBundle:Task:view.html.twig', [
            'task' => $task
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
            $tasks = $em->getRepository('DiamondRecruiterRecruiterBundle:Task')->getSearch($request->get('search'));
            return $this->render('DiamondRecruiterRecruiterBundle:Task:view_all.html.twig', [
                'tasks' => $tasks,
                'search' => true
            ]);
        }

        $paginator  = $this->get('knp_paginator');
        $tasks = $paginator->paginate($user->getTasks(), $request->query->getInt('page', 1), 12);

        return $this->render('DiamondRecruiterRecruiterBundle:Task:view_all.html.twig', [
            'tasks' => $tasks
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

        $task = new Task();

        $form = $this->createForm(TaskType::class, $task,[
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);

        if($form->isValid()) {
            $task->setDateCreated(new \DateTime());
            $task->setUser($user);
            $task->setTenant($user->getTenant());
            $em->persist($task);
            $em->flush();

            return $this->redirect($this->generateUrl('diamond_task_view', [
                'id' => $task->getId(),
                'tenant' => $user->getTenant()->getName()
            ]));
        }

        return $this->render('DiamondRecruiterRecruiterBundle:Task:create.html.twig', [
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

        $task = $em->getRepository('DiamondRecruiterRecruiterBundle:Task')->find($id);

        $form = $this->createForm(TaskType::class, $task,[
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);
        if($form->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('diamond_task_view', [
                'id' => $task->getId(),
                'tenant' => $user->getTenant()->getName()
            ]));
        }

        return $this->render('DiamondRecruiterRecruiterBundle:Task:edit.html.twig', [
            'form' => $form->createView(),
            'task' => $task
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

        $task = $em->getRepository('DiamondRecruiterRecruiterBundle:Task')->find($id);

        try {
            $em->remove($task);
            $em->flush();
        } catch (ForeignKeyConstraintViolationException $exception) {
            $this->addFlash("notification", "Could not delete task because it has connected entities");
        }

        return $this->redirect($this->generateUrl('diamond_task_view_all', [
            'tenant' => $user->getTenant()->getName(),
            'tasks' => $user->getTasks()
        ]));
    }
}
