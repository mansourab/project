<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        $user = new User();

        $password = $this->encoder->encodePassword($user, 'admin');

        $user->setEmail('abdoulaye.mansour@gmail.com');
        $user->setPassword($password);

        $manager->persist($user);

        $manager->flush();
    }
}
