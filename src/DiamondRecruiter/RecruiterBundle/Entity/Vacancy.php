<?php

namespace DiamondRecruiter\RecruiterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vacancy
 *
 * @ORM\Table(name="diamond_vacancy")
 * @ORM\Entity(repositoryClass="DiamondRecruiter\RecruiterBundle\Repository\VacancyRepository")
 */
class Vacancy
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
     * @var int
     *
     * @ORM\Column(name="reed_job_id", type="integer", unique=true, nullable=true)
     */
    private $reedJobId;


    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="locationName", type="string", length=255)
     */
    private $location;

    /**
     * @var int
     *
     * @ORM\Column(name="minimumSalary", type="integer", nullable=true)
     */
    private $minimumSalary;

    /**
     * @var int
     *
     * @ORM\Column(name="maximumSalary", type="integer", nullable=true)
     */
    private $maximumSalary;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=255, nullable=true)
     */
    private $currency;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expirationDate", type="datetime")
     */
    private $expirationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="jobDescription", type="text", nullable=true)
     */
    private $jobDescription;

    /**
     * @var int
     *
     * @ORM\Column(name="applications", type="integer", nullable=true)
     */
    private $applications;

    /**
     * @var string
     *
     * @ORM\Column(name="jobUrl", type="string", length=255, nullable=true)
     */
    private $jobUrl;

    /**
     * @var \DiamondRecruiter\RecruiterBundle\Entity\Tenant
     * @ORM\ManyToOne(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Tenant", inversedBy="vacancies")
     * @ORM\JoinColumn(name="tenant", referencedColumnName="id")
     */
    private $tenant;

    /**
     * @var \DiamondRecruiter\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="DiamondRecruiter\UserBundle\Entity\User", inversedBy="vacancies")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    /**
     * @var \DiamondRecruiter\RecruiterBundle\Entity\Client
     * @ORM\ManyToOne(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Client", inversedBy="vacancies")
     * @ORM\JoinColumn(name="client", referencedColumnName="id")
     */
    private $client;

    /**
     * Inverse Side
     *
     * @ORM\ManyToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Candidate", mappedBy="vacancies")
     */
    private $candidates;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Submission", mappedBy="vacancy")
     */
    protected $submissions;

    /**
     * @ORM\OneToOne(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Placement")
     * @ORM\JoinColumn(name="placement", referencedColumnName="id", onDelete="CASCADE")
     */
    private $placement;


    public function __toString() {
        return $this->title . " - " . $this->getClient()->getName();
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
     * Set minimumSalary
     *
     * @param integer $minimumSalary
     *
     * @return Vacancy
     */
    public function setMinimumSalary($minimumSalary)
    {
        $this->minimumSalary = $minimumSalary;

        return $this;
    }

    /**
     * Get minimumSalary
     *
     * @return int
     */
    public function getMinimumSalary()
    {
        return $this->minimumSalary;
    }

    /**
     * Set maximumSalary
     *
     * @param integer $maximumSalary
     *
     * @return Vacancy
     */
    public function setMaximumSalary($maximumSalary)
    {
        $this->maximumSalary = $maximumSalary;

        return $this;
    }

    /**
     * Get maximumSalary
     *
     * @return int
     */
    public function getMaximumSalary()
    {
        return $this->maximumSalary;
    }

    /**
     * Set currency
     *
     * @param string $currency
     *
     * @return Vacancy
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set expirationDate
     *
     * @param \DateTime $expirationDate
     *
     * @return Vacancy
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * Get expirationDate
     *
     * @return \DateTime
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Vacancy
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set jobDescription
     *
     * @param string $jobDescription
     *
     * @return Vacancy
     */
    public function setJobDescription($jobDescription)
    {
        $this->jobDescription = $jobDescription;

        return $this;
    }

    /**
     * Get jobDescription
     *
     * @return string
     */
    public function getJobDescription()
    {
        return $this->jobDescription;
    }

    /**
     * Set applications
     *
     * @param integer $applications
     *
     * @return Vacancy
     */
    public function setApplications($applications)
    {
        $this->applications = $applications;

        return $this;
    }

    /**
     * Get applications
     *
     * @return int
     */
    public function getApplications()
    {
        return $this->applications;
    }

    /**
     * Set jobUrl
     *
     * @param string $jobUrl
     *
     * @return Vacancy
     */
    public function setJobUrl($jobUrl)
    {
        $this->jobUrl = $jobUrl;

        return $this;
    }

    /**
     * Get jobUrl
     *
     * @return string
     */
    public function getJobUrl()
    {
        return $this->jobUrl;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->candidates = new \Doctrine\Common\Collections\ArrayCollection();
        $this->submissions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set tenant
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Tenant $tenant
     *
     * @return Vacancy
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
     * @return Vacancy
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
     * @return Vacancy
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
     * Add candidate
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Candidate $candidate
     *
     * @return Vacancy
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
     * Add submission
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Submission $submission
     *
     * @return Vacancy
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
     * Set placement
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Placement $placement
     *
     * @return Vacancy
     */
    public function setPlacement(\DiamondRecruiter\RecruiterBundle\Entity\Placement $placement = null)
    {
        $this->placement = $placement;

        return $this;
    }

    /**
     * Get placement
     *
     * @return \DiamondRecruiter\RecruiterBundle\Entity\Placement
     */
    public function getPlacement()
    {
        return $this->placement;
    }

    /**
     * Set reedJobId
     *
     * @param integer $reedJobId
     *
     * @return Vacancy
     */
    public function setReedJobId($reedJobId)
    {
        $this->reedJobId = $reedJobId;

        return $this;
    }

    /**
     * Get reedJobId
     *
     * @return integer
     */
    public function getReedJobId()
    {
        return $this->reedJobId;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Vacancy
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
     * Set location
     *
     * @param string $location
     *
     * @return Vacancy
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }
}
