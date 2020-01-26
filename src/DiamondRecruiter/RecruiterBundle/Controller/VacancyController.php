<?php

namespace DiamondRecruiter\RecruiterBundle\Controller;

use DiamondRecruiter\RecruiterBundle\Entity\Client;
use DiamondRecruiter\RecruiterBundle\Entity\Vacancy;
use DiamondRecruiter\RecruiterBundle\Form\VacancyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class VacancyController extends Controller
{
    public function viewAction(Request $request, $id)
    {
        $em = $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($this->getUser()->getId());
        if (!$this->get('diamond_recruiter_tenant_check')->check($user, $request)) {
            return $this->render('DiamondRecruiterRecruiterBundle:Pages:error.html.twig', [
            ]);
        }

        $vacancy = $em->getRepository('DiamondRecruiterRecruiterBundle:Vacancy')->find($id);

        return $this->render('DiamondRecruiterRecruiterBundle:Vacancy:view.html.twig', [
            'vacancy' => $vacancy
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

        $paginator  = $this->get('knp_paginator');

        if ($request->get('search')) {
            $vacancies = $em->getRepository('DiamondRecruiterRecruiterBundle:Vacancy')->getSearch($request->get('search'));
            return $this->render('DiamondRecruiterRecruiterBundle:Vacancy:view_all.html.twig', [
                'vacancies' => $vacancies,
                'search' => true
            ]);
        }

        $vacancies = $paginator->paginate($user->getVacancies(), $request->query->getInt('page', 1), 12);
        return $this->render('DiamondRecruiterRecruiterBundle:Vacancy:view_all.html.twig', [
            'vacancies' => $vacancies
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

        $vacancy = new Vacancy();

        $form = $this->createForm(VacancyType::class, $vacancy,[
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);

        if($form->isValid()) {
            $vacancy->setDate(new \DateTime());
            $vacancy->setUser($user);
            $vacancy->setTenant($user->getTenant());
            $em->persist($vacancy);
            $em->flush();

            return $this->redirect($this->generateUrl('diamond_vacancy_view', [
                'id' => $vacancy->getId(),
                'tenant' => $user->getTenant()->getName()
            ]));
        }

        return $this->render('DiamondRecruiterRecruiterBundle:Vacancy:create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function createReedAction($id, Request $request)
    {
        $em = $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($this->getUser()->getId());
        if (!$this->get('diamond_recruiter_tenant_check')->check($user, $request)) {
            return $this->render('DiamondRecruiterRecruiterBundle:Pages:error.html.twig', [
            ]);
        }

        $vac = $em->getRepository('DiamondRecruiterRecruiterBundle:Vacancy')->findOneBy(['reedJobId' => $id]);

        if ($vac) {
            return $this->render('DiamondRecruiterRecruiterBundle:Vacancy:create_reed.html.twig', [
                'vacancy' => $vac
            ]);
        } else {
            $reed_vacancy = $this->get('diamond_recruiter_reed_vacancy_details')->getVacancy($id);
            $c = $em->getRepository('DiamondRecruiterRecruiterBundle:Client')->findOneBy(['reedId' => $reed_vacancy['employerId']]);
            $client = new Client();
            $vacancy = new Vacancy();
            if (!$c) {
                $client = new Client();
                $client->setReedId($reed_vacancy['employerId']);
                $client->setDateCreated(new \DateTime());
                $client->setContacted(0);
                $client->setAddress('');
                $client->setIsActive(1);
                $client->setIsCustomer(0);
                $client->setWebsite('');
                $client->setTenant($user->getTenant());
                $client->setUser($user);
                $client->setName($reed_vacancy['employerName']);
                $client->setEmail('');
                $client->setLastContacted(new \DateTime());
                $em->persist($client);
                $em->flush();
                $vacancy->setClient($client);
            } else {
                $vacancy->setClient($c);
            }

            $vacancy->setUser($user);
            $vacancy->setTenant($user->getTenant());
            $vacancy->setDate(new \DateTime());

            if (!$c) {
                $vacancy->setClient($client);
            } else {
                $vacancy->setClient($c);
            }

            $vacancy->setExpirationDate(new \DateTime(str_replace("/", "-", $reed_vacancy['expirationDate'])));
            $vacancy->setJobDescription($reed_vacancy['jobDescription']);
            $vacancy->setJobUrl($reed_vacancy['jobUrl']);
            $vacancy->setLocation($reed_vacancy['locationName']);
            $vacancy->setMaximumSalary($reed_vacancy['maximumSalary']);
            $vacancy->setMinimumSalary($reed_vacancy['minimumSalary']);
            $vacancy->setCurrency($reed_vacancy['currency']);
            $vacancy->setReedJobId($reed_vacancy['jobId']);
            $vacancy->setTitle($reed_vacancy['jobTitle']);
            $em->persist($vacancy);
            $em->flush();

            $paginator  = $this->get('knp_paginator');
            $vacancies = $paginator->paginate($user->getVacancies(), $request->query->getInt('page', 1), 12);

            return $this->redirect($this->generateUrl('diamond_vacancy_view_all', [
                'vacancies' => $vacancies,
                'tenant' => $user->getTenant()->getName()
            ]));
        }
    }

    public function searchReedAction(Request $request)
    {
        $em = $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('DiamondRecruiterUserBundle:User')->find($this->getUser()->getId());
        if (!$this->get('diamond_recruiter_tenant_check')->check($user, $request)) {
            return $this->render('DiamondRecruiterRecruiterBundle:Pages:error.html.twig', [
            ]);
        }

        if ($request->get("keywords")) {
            $req =  $request->request->all();
            $str = "";
            foreach ($req as $key => $value) {
                if ($value == 'on') {
                    $value = "true";
                }
                $str = $str . $key .  "=" . $value . "&";
            }
            $str = $str . "postedByDirectEmployer=true";
            $vacs = $this->get('diamond_recruiter_reed_vacancies')->getVacancies($str);

            return $this->render('DiamondRecruiterRecruiterBundle:Vacancy:create_reed.html.twig', [
                'reedVacancies' => $vacs
            ]);

        }

        return $this->render('DiamondRecruiterRecruiterBundle:Vacancy:create_reed.html.twig', [
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

        $vacancy = $em->getRepository('DiamondRecruiterRecruiterBundle:Vacancy')->find($id);

        $form = $this->createForm(VacancyType::class, $vacancy,[
            'action' => $request->getUri()
        ]);

        $form->handleRequest($request);
        if($form->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('diamond_vacancy_view', [
                'id' => $vacancy->getId(),
                'tenant' => $user->getTenant()->getName()
            ]));
        }

        return $this->render('DiamondRecruiterRecruiterBundle:Vacancy:edit.html.twig', [
            'form' => $form->createView(),
            'vacancy' => $vacancy
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

        $vacancy = $em->getRepository('DiamondRecruiterRecruiterBundle:Vacancy')->find($id);

        try {
            $em->remove($vacancy);
            $em->flush();
        } catch (ForeignKeyConstraintViolationException $exception) {
            $this->addFlash("notification", "Could not delete vacancy because it has connected entities");
        }

        return $this->redirect($this->generateUrl('diamond_vacancy_view_all', [
            'tenant' => $user->getTenant()->getName(),
            'vacancies' => $user->getVacancies()
        ]));
    }
}
