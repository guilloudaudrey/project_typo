<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proofreader
 *
 * @ORM\Table(name="proofreader")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProofreaderRepository")
 */
class Proofreader
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
     * @ORM\Column(name="rating", type="integer", nullable=true)
     */
    private $rating;

    
    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user_id;

    /**
    * @ORM\OneToMany(targetEntity="Correction", mappedBy="proofreader")
    */
    private $corrections;

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
     * Set rating
     *
     * @param integer $rating
     *
     * @return Proofreader
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }


    /**
     * Set userId
     *
     * @param \AppBundle\Entity\User $userId
     *
     * @return Proofreader
     */
    public function setUserId(\AppBundle\Entity\User $userId = null)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \AppBundle\Entity\User
     */
    public function getUserId()
    {
        return $this->user_id;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->corrections = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add correction
     *
     * @param \AppBundle\Entity\correction $correction
     *
     * @return Proofreader
     */
    public function addCorrection(\AppBundle\Entity\correction $correction)
    {
        $this->corrections[] = $correction;

        return $this;
    }

    /**
     * Remove correction
     *
     * @param \AppBundle\Entity\correction $correction
     */
    public function removeCorrection(\AppBundle\Entity\correction $correction)
    {
        $this->corrections->removeElement($correction);
    }

    /**
     * Get corrections
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCorrections()
    {
        return $this->corrections;
    }
}
