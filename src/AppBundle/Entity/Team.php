<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 *
 * @ORM\Table(name="Team")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeamRepository")
 *
 */
class Team
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
     * @Assert\Length(min = 2, max = 30)
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 20000)
     * @ORM\Column(name="number", type="integer")
     */
    private $rating;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Player", mappedBy="team", cascade={"persist"})
     */
    private $players;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Result", mappedBy="team", cascade={"persist"})
     */
    private $results;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->players = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Team
     */
    public function setType($type)
    {
        $this->type = $type;
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
     * Set description
     *
     * @param string $description
     * @return Team
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     * @return Team
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
        return $this;
    }

    /**
     * Set Player
     * @param Player $player
     * @return Team
     */
    public function setPlayer(Player $player)
    {
        $this->players[] = $player;
    }

    /**
     * Get players
     *
     * @return array
     */
    public function getPlayers()
    {
        return $this->players;
    }

    public function addPlayer(Player $player)
    {
        $this->players->add($player);
    }

    public function removePlayer(Result $player)
    {
        $this->players->remove($player);
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
     * @return Team
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Set Result
     * @param Result $result
     * @return Team
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
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
