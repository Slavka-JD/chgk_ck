<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Result
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResultRepository")
 *
 */
class Result
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
     * @var
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tournament", mappedBy="result", cascade={"persist"})
     */
    private $tournament;

    /**
     * @var
     * @Assert\NotBlank()
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Team", mappedBy="result", cascade={"persist"})
     */
    private $team;

    /**
     * @var integer
     * @Assert\NotBlank()
     * @Assert\Length(min = 0, max = 45)
     * @ORM\Column(name="number", type="integer")
     */
    private $points;

    /**
     * @var integer
     * @Assert\NotBlank()
     * @Assert\Length(min = 1, max = 20)
     * @ORM\Column(name="number", type="integer")
     */
    private $place;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->teams = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get tournament
     *
     * @return Tournament
     */
    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * Set Tournament
     * @param Tournament $tournament
     * @return Result
     */
    public function setTournament(Tournament $tournament = null)
    {
        $this->tournament = $tournament;
        return $this;
    }

    /**
     * Get team
     *
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set team
     *
     * @param Team $team
     * @return Result
     */
    public function setTeam(Team $team = null)
    {
        $this->team = $team;
        return $this;
    }

    /**
     * Get points
     *
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set points
     *
     * @param integer $points
     * @return Result
     */
    public function setPoints($points)
    {
        $this->points = $points;
        return $this;
    }

    /**
     * Get place
     *
     * @return integer
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set place
     *
     * @param integer $place
     * @return Result
     */
    public function setPlace($place)
    {
        $this->place = $place;
        return $this;
    }
}
