<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Table(name="Event")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 * @ORM\HasLifecycleCallbacks()
 *
 */
class Event
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 50)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     *
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $author;

    /**
     * @var /Datetime
     *
     * @ORM\Column(name="eventdate", type="date", nullable=true)
     */
    private $eventdate;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="createdAt")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="deletedAt")
     */
    private $deletedAt;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(type="string", length=255, unique=true )
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="event", orphanRemoval=true)
     */
    private $comment;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comment = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * Set title
     *
     * @param  string $title
     * @return Event
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     * Set text
     *
     * @param  string $text
     * @return Event
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set author
     *
     * @param  string $author
     * @return Event
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Get eventdate
     *
     * @return string
     */
    public function getEventdate()
    {
        return $this->eventdate;
    }

    /**
     * Set eventdate
     *
     * @param string $eventdate
     * @return Event
     */
    public function setEventdate($eventdate)
    {
        $this->eventdate = $eventdate;
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
     * Set createdAt
     *
     * @param  \DateTime $createdAt
     * @return Event
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set deletedAt
     *
     * @param  \DateTime $deletedAt
     * @return Event
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param  string $slug
     * @return Event
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Add Comment
     *
     * @param \AppBundle\Entity\Comment $comment
     * @return Event
     */
    public function addComment(\AppBundle\Entity\Comment $comment)
    {
        $this->comment[] = $comment;
        return $this;
    }

    /**
     * Remove Comment
     *
     * @param \AppBundle\Entity\Comment $comment
     */
    public function removeComment(\AppBundle\Entity\Comment $comment)
    {
        $this->comment->removeElement($comment);
    }

    /**
     * Get Comment
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComment()
    {
        return $this->comment;
    }
}
