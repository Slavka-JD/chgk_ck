<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Tournament
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TournamentRepository")
 *
 */
class Tournament
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 50)
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
     * @var /Datetime
     *
     * @ORM\Column(name="playdate", type="date")
     */
    private $playdate;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Result", mappedBy="tournament", cascade={"persist"})
     */
    private $results;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->results = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Tournament
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get playdate
     *
     * @return string
     */
    public function getPlaydate()
    {
        return $this->playdate;
    }

    /**
     * Set playdate
     *
     * @param string $playdate
     * @return Tournament
     */
    public function setPlaydate($playdate)
    {
        $this->playdate = $playdate;
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
     * @param string $slug
     * @return Tournament
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    public function __toString()
    {
        return $this->getName();
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
     * Set name
     *
     * @param string $name
     * @return Tournament
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Set Result
     * @param Result $result
     * @return Tournament
     */
    public function setResult(Result $result)
    {
        $this->results[] = $result;
    }

    /**
     * Get results
     *
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }

    public function addResult(Result $result)
    {
        $this->results->add($result);
    }

    public function removeResult(Result $result)
    {
        $this->results->remove($result);
    }
}
