<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends AbstractFixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $userFirst = new User();
        $userFirst->setUsername('Anton');
        $userFirst->setPassword(password_hash('4045487', PASSWORD_BCRYPT));
        $manager->persist($userFirst);
        $manager->flush();
    }
}
