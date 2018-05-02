<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Correction
 *
 * @ORM\Table(name="correction")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CorrectionRepository")
 */
class Correction
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
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var int
     *
     * @ORM\Column(name="validations_number", type="integer")
     */
    private $validationsNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     */
    private $comment;

    /**
    * @ORM\ManyToOne(targetEntity="Post", inversedBy="corrections")
    * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
    */
   private $post;

    /**
    * @ORM\ManyToOne(targetEntity="Proofreader", inversedBy="corrections")
    * @ORM\JoinColumn(name="proofreader_id", referencedColumnName="id")
    */
    private $proofreader;

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
     * Set text
     *
     * @param string $text
     *
     * @return Correction
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Correction
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Correction
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set validationsNumber
     *
     * @param integer $validationsNumber
     *
     * @return Correction
     */
    public function setValidationsNumber($validationsNumber)
    {
        $this->validationsNumber = $validationsNumber;

        return $this;
    }

    /**
     * Get validationsNumber
     *
     * @return int
     */
    public function getValidationsNumber()
    {
        return $this->validationsNumber;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Correction
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set post
     *
     * @param \AppBundle\Entity\Post $post
     *
     * @return Correction
     */
    public function setPost(\AppBundle\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \AppBundle\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set proofreader
     *
     * @param \AppBundle\Entity\Proofreader $proofreader
     *
     * @return Correction
     */
    public function setProofreader(\AppBundle\Entity\Proofreader $proofreader = null)
    {
        $this->proofreader = $proofreader;

        return $this;
    }

    /**
     * Get proofreader
     *
     * @return \AppBundle\Entity\Proofreader
     */
    public function getProofreader()
    {
        return $this->proofreader;
    }
}
