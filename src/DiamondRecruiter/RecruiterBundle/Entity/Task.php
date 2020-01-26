<?php

namespace DiamondRecruiter\RecruiterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="diamond_task")
 * @ORM\Entity(repositoryClass="DiamondRecruiter\RecruiterBundle\Repository\TaskRepository")
 */
class Task
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime")
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_time", type="datetime")
     */
    private $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_time", type="datetime", nullable=true)
     */
    private $endTime;

    /**
     * @var \DiamondRecruiter\RecruiterBundle\Entity\Tenant
     * @ORM\ManyToOne(targetEntity="DiamondRecruiter\RecruiterBundle\Entity\Tenant", inversedBy="tasks")
     * @ORM\JoinColumn(name="tenant", referencedColumnName="id")
     */
    private $tenant;

    /**
     * @var \DiamondRecruiter\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="DiamondRecruiter\UserBundle\Entity\User", inversedBy="tasks")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;


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
     * @return Task
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
     * Set description
     *
     * @param string $description
     *
     * @return Task
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Task
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
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return Task
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return Task
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set tenant
     *
     * @param \DiamondRecruiter\RecruiterBundle\Entity\Tenant $tenant
     *
     * @return Task
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
     * @return Task
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
}
