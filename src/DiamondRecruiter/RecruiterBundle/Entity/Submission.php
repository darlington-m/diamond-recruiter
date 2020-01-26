<?php

namespace DiamondRecruiter\RecruiterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Submission
 *
 * @ORM\Table(name="diamond_submission")
 * @ORM\Entity(repositoryClass="DiamondRecruiter\RecruiterBundle\Repository\SubmissionRepository")
 */
class Submission
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text")
     */
    private $notes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime")
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_submitted", type="datetime")
     */
    private $dateSubmitted;

    /**
     * @var \DiamondRecruiter\RecruiterBundle\Entity\Tenant
     * @ORM\ManyToOne(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Tenant", inversedBy="submissions")
     * @ORM\JoinColumn(name="tenant", referencedColumnName="id")
     */
    private $tenant;

    /**
     * @var \DiamondRecruiter\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="DiamondRecruiter\UserBundle\Entity\User", inversedBy="submissions")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    /**
     * @var \DiamondRecruiter\RecruiterBundle\Entity\Client
     * @ORM\ManyToOne(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Client", inversedBy="submissions")
     * @ORM\JoinColumn(name="client", referencedColumnName="id")
     */
    private $client;

    /**
     * @var \DiamondRecruiter\RecruiterBundle\Entity\Candidate
     * @ORM\ManyToOne(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Candidate", inversedBy="submissions")
     * @ORM\JoinColumn(name="candidate", referencedColumnName="id")
     */
    private $candidate;

    /**
     * @var \DiamondRecruiter\RecruiterBundle\Entity\Vacancy
     * @ORM\ManyToOne(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Vacancy", inversedBy="submissions")
     * @ORM\JoinColumn(name="vacancy", referencedColumnName="id")
     */
    private $vacancy;


    public function __toString() {
        return $this->title;
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
     * Set title
     *
     * @param string $title
     *
     * @return Submission
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return Submission
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Submission
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateSubmitted
     *
     * @param \DateTime $dateSubmitted
     *
     * @return Submission
     */
    public function setDateSubmitted($dateSubmitted)
    {
        $this->dateSubmitted = $dateSubmitted;

        return $this;
    }

    /**
     * Get dateSubmitted
     *
     * @return \DateTime
     */
    public function getDateSubmitted()
    {
        return $this->dateSubmitted;
    }

    /**
     * Set tenant
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Tenant $tenant
     *
     * @return Submission
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
     * Set user
     *
     * @param \DiamondRecruiter\UserBundle\Entity\User $user
     *
     * @return Submission
     */
    public function setUser(\DiamondRecruiter\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \DiamondRecruiter\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set client
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Client $client
     *
     * @return Submission
     */
    public function setClient(\DiamondRecruiter\RecruiterBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \DiamondRecruiter\RecruiterBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set candidate
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Candidate $candidate
     *
     * @return Submission
     */
    public function setCandidate(\DiamondRecruiter\RecruiterBundle\Entity\Candidate $candidate = null)
    {
        $this->candidate = $candidate;

        return $this;
    }

    /**
     * Get candidate
     *
     * @return \DiamondRecruiter\RecruiterBundle\Entity\Candidate
     */
    public function getCandidate()
    {
        return $this->candidate;
    }

    /**
     * Set vacancy
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Vacancy $vacancy
     *
     * @return Submission
     */
    public function setVacancy(\DiamondRecruiter\RecruiterBundle\Entity\Vacancy $vacancy = null)
    {
        $this->vacancy = $vacancy;

        return $this;
    }

    /**
     * Get vacancy
     *
     * @return \DiamondRecruiter\RecruiterBundle\Entity\Vacancy
     */
    public function getVacancy()
    {
        return $this->vacancy;
    }
}
