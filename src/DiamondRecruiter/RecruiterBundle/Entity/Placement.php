<?php

namespace DiamondRecruiter\RecruiterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Placement
 *
 * @ORM\Table(name="diamond_placement")
 * @ORM\Entity(repositoryClass="DiamondRecruiter\RecruiterBundle\Repository\PlacementRepository")
 */
class Placement
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime")
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime")
     */
    private $endDate;

    /**
     * @var \DiamondRecruiter\RecruiterBundle\Entity\Tenant
     * @ORM\ManyToOne(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Tenant", inversedBy="placements")
     * @ORM\JoinColumn(name="tenant", referencedColumnName="id")
     */
    private $tenant;

    /**
     * @var \DiamondRecruiter\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="DiamondRecruiter\UserBundle\Entity\User", inversedBy="placements")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    /**
     * @var \DiamondRecruiter\RecruiterBundle\Entity\Client
     * @ORM\ManyToOne(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Client", inversedBy="placements")
     * @ORM\JoinColumn(name="client", referencedColumnName="id")
     */
    private $client;

    /**
     * @ORM\OneToOne(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Candidate")
     * @ORM\JoinColumn(name="candidate", referencedColumnName="id")
     */
    private $candidate;

    /**
     * @ORM\OneToOne(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Submission")
     * @ORM\JoinColumn(name="submission", referencedColumnName="id")
     */
    private $submission;

    /**
     * @ORM\OneToOne(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Vacancy")
     * @ORM\JoinColumn(name="vacancy", referencedColumnName="id", onDelete="CASCADE")
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
     * @return Placement
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Placement
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
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Placement
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Placement
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set tenant
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Tenant $tenant
     *
     * @return Placement
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
     * @return Placement
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
     * @return Placement
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
     * @return Placement
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
     * @return Placement
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

    /**
     * Set submission
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Submission $submission
     *
     * @return Placement
     */
    public function setSubmission(\DiamondRecruiter\RecruiterBundle\Entity\Submission $submission = null)
    {
        $this->submission = $submission;

        return $this;
    }

    /**
     * Get submission
     *
     * @return \DiamondRecruiter\RecruiterBundle\Entity\Submission
     */
    public function getSubmission()
    {
        return $this->submission;
    }
}
