<?php

namespace DiamondRecruiter\RecruiterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="diamond_client")
 * @ORM\Entity(repositoryClass="DiamondRecruiter\RecruiterBundle\Repository\ClientRepository")
 */
class Client
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
     * @ORM\Column(name="reed_id", type="integer")
     */
    private $reedId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text")
     */
    private $address;

    /**
     * @var boolean
     *
     * @ORM\Column(name="contacted", type="boolean")
     */
    private $contacted;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_customer", type="boolean")
     */
    private $isCustomer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime")
     */
    private $dateCreated;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255)
     */
    private $website;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_contacted", type="datetime")
     */
    private $lastContacted;

    /**
     * @var \DiamondRecruiter\RecruiterBundle\Entity\Tenant
     * @ORM\ManyToOne(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Tenant", inversedBy="clients")
     * @ORM\JoinColumn(name="tenant", referencedColumnName="id")
     */
    private $tenant;

    /**
     * @var \DiamondRecruiter\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="DiamondRecruiter\UserBundle\Entity\User", inversedBy="clients")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Contact", mappedBy="client")
     */
    protected $contacts;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Placement", mappedBy="client")
     */
    protected $placements;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Submission", mappedBy="client")
     */
    protected $submissions;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Vacancy", mappedBy="client")
     */
    protected $vacancies;


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
     * @return Client
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
     * Set address
     *
     * @param string $address
     *
     * @return Client
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Client
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
     * Set email
     *
     * @param string $email
     *
     * @return Client
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return Client
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set lastContacted
     *
     * @param \DateTime $lastContacted
     *
     * @return Client
     */
    public function setLastContacted($lastContacted)
    {
        $this->lastContacted = $lastContacted;

        return $this;
    }

    /**
     * Get lastContacted
     *
     * @return \DateTime
     */
    public function getLastContacted()
    {
        return $this->lastContacted;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contacts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->placements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->submissions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->vacancies = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set tenant
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Tenant $tenant
     *
     * @return Client
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
     * @return Client
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
     * Add contact
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Contact $contact
     *
     * @return Client
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
     * @return Client
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
     * @return Client
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
     * Add vacancy
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Vacancy $vacancy
     *
     * @return Client
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

    /**
     * Set contacted
     *
     * @param boolean $contacted
     *
     * @return Client
     */
    public function setContacted($contacted)
    {
        $this->contacted = $contacted;

        return $this;
    }

    /**
     * Get contacted
     *
     * @return boolean
     */
    public function getContacted()
    {
        return $this->contacted;
    }

    /**
     * Set isCustomer
     *
     * @param boolean $isCustomer
     *
     * @return Client
     */
    public function setIsCustomer($isCustomer)
    {
        $this->isCustomer = $isCustomer;

        return $this;
    }

    /**
     * Get isCustomer
     *
     * @return boolean
     */
    public function getIsCustomer()
    {
        return $this->isCustomer;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Client
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set reedId
     *
     * @param integer $reedId
     *
     * @return Client
     */
    public function setReedId($reedId)
    {
        $this->reedId = $reedId;

        return $this;
    }

    /**
     * Get reedId
     *
     * @return integer
     */
    public function getReedId()
    {
        return $this->reedId;
    }
}
