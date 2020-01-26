<?php

namespace DiamondRecruiter\RecruiterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tenant
 *
 * @ORM\Table(name="diamond_tenant")
 * @ORM\Entity(repositoryClass="DiamondRecruiter\RecruiterBundle\Repository\TenantRepository")
 */
class Tenant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetime")
     */
    private $timestamp;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\UserBundle\Entity\User", mappedBy="tenant")
     */
    protected $users;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Candidate", mappedBy="tenant")
     */
    protected $candidates;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Client", mappedBy="tenant")
     */
    protected $clients;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Contact", mappedBy="tenant")
     */
    protected $contacts;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Placement", mappedBy="tenant")
     */
    protected $placements;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Submission", mappedBy="tenant")
     */
    protected $submissions;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Task", mappedBy="tenant")
     */
    protected $tasks;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Vacancy", mappedBy="tenant")
     */
    protected $vacancies;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return $this->name;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Tenant
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     *
     * @return Tenant
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Add user
     *
     * @param \DiamondRecruiter\UserBundle\Entity\User $user
     *
     * @return Tenant
     */
    public function addUser(\DiamondRecruiter\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \DiamondRecruiter\UserBundle\Entity\User $user
     */
    public function removeUser(\DiamondRecruiter\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add candidate
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Candidate $candidate
     *
     * @return Tenant
     */
    public function addCandidate(\DiamondRecruiter\RecruiterBundle\Entity\Candidate $candidate)
    {
        $this->candidates[] = $candidate;

        return $this;
    }

    /**
     * Remove candidate
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Candidate $candidate
     */
    public function removeCandidate(\DiamondRecruiter\RecruiterBundle\Entity\Candidate $candidate)
    {
        $this->candidates->removeElement($candidate);
    }

    /**
     * Get candidates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCandidates()
    {
        return $this->candidates;
    }

    /**
     * Add client
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Client $client
     *
     * @return Tenant
     */
    public function addClient(\DiamondRecruiter\RecruiterBundle\Entity\Client $client)
    {
        $this->clients[] = $client;

        return $this;
    }

    /**
     * Remove client
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Client $client
     */
    public function removeClient(\DiamondRecruiter\RecruiterBundle\Entity\Client $client)
    {
        $this->clients->removeElement($client);
    }

    /**
     * Get clients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClients()
    {
        return $this->clients;
    }

    /**
     * Add contact
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Contact $contact
     *
     * @return Tenant
     */
    public function addContact(\DiamondRecruiter\RecruiterBundle\Entity\Contact $contact)
    {
        $this->contacts[] = $contact;

        return $this;
    }

    /**
     * Remove contact
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Contact $contact
     */
    public function removeContact(\DiamondRecruiter\RecruiterBundle\Entity\Contact $contact)
    {
        $this->contacts->removeElement($contact);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Add placement
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Placement $placement
     *
     * @return Tenant
     */
    public function addPlacement(\DiamondRecruiter\RecruiterBundle\Entity\Placement $placement)
    {
        $this->placements[] = $placement;

        return $this;
    }

    /**
     * Remove placement
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Placement $placement
     */
    public function removePlacement(\DiamondRecruiter\RecruiterBundle\Entity\Placement $placement)
    {
        $this->placements->removeElement($placement);
    }

    /**
     * Get placements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlacements()
    {
        return $this->placements;
    }

    /**
     * Add submission
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Submission $submission
     *
     * @return Tenant
     */
    public function addSubmission(\DiamondRecruiter\RecruiterBundle\Entity\Submission $submission)
    {
        $this->submissions[] = $submission;

        return $this;
    }

    /**
     * Remove submission
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Submission $submission
     */
    public function removeSubmission(\DiamondRecruiter\RecruiterBundle\Entity\Submission $submission)
    {
        $this->submissions->removeElement($submission);
    }

    /**
     * Get submissions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubmissions()
    {
        return $this->submissions;
    }

    /**
     * Add task
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Task $task
     *
     * @return Tenant
     */
    public function addTask(\DiamondRecruiter\RecruiterBundle\Entity\Task $task)
    {
        $this->tasks[] = $task;

        return $this;
    }

    /**
     * Remove task
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Task $task
     */
    public function removeTask(\DiamondRecruiter\RecruiterBundle\Entity\Task $task)
    {
        $this->tasks->removeElement($task);
    }

    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * Add vacancy
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Vacancy $vacancy
     *
     * @return Tenant
     */
    public function addVacancy(\DiamondRecruiter\RecruiterBundle\Entity\Vacancy $vacancy)
    {
        $this->vacancies[] = $vacancy;

        return $this;
    }

    /**
     * Remove vacancy
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Vacancy $vacancy
     */
    public function removeVacancy(\DiamondRecruiter\RecruiterBundle\Entity\Vacancy $vacancy)
    {
        $this->vacancies->removeElement($vacancy);
    }

    /**
     * Get vacancies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVacancies()
    {
        return $this->vacancies;
    }
}
