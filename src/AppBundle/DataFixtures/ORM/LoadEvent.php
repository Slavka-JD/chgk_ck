<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Event;

class LoadEvent implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
    }
}