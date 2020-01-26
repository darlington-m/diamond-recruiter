<?php
/**
 * Created by PhpStorm.
 * User: darlington
 * Date: 26/11/16
 * Time: 11:56
 */

namespace DiamondRecruiter\UserBundle\Entity;


use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="diamond_user")
 * @ORM\Entity(repositoryClass="DiamondRecruiter\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="DiamondRecruiter\UserBundle\Entity\Group")
     * @ORM\JoinTable(name="diamond_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;


    /**
     * @var \DiamondRecruiter\RecruiterBundle\Entity\Tenant
     * @ORM\ManyToOne(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Tenant", inversedBy="users")
     * @ORM\JoinColumn(name="tenant", referencedColumnName="id")
     */
    private $tenant;


    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Candidate", mappedBy="user")
     */
    protected $candidates;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Client", mappedBy="user")
     */
    protected $clients;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Contact", mappedBy="user")
     */
    protected $contacts;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Placement", mappedBy="user")
     */
    protected $placements;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Submission", mappedBy="user")
     */
    protected $submissions;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Task", mappedBy="user")
     */
    protected $tasks;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Vacancy", mappedBy="user")
     */
    protected $vacancies;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set tenant
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Tenant $tenant
     *
     * @return User
     */
    public function setTenant(\DiamondRecruiter\RecruiterBundle\Entity\Tenant $tenant = null)
    {
        $this->tenant = $tenant;

        return $this;
    }

    /**
     * Get tenant
     *
     * @return \DiamondRecruiter\RecruiterBundle\Entity\Tenant
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * Add candidate
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Candidate $candidate
     *
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
