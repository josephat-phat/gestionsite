<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Utilisateur;

class AppFixtures extends Fixture
{
    private $encoder;
        
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        
        for ($i = 0; $i < 2; $i++) {
            $utilisateur = new Utilisateur();
            $passeword = $this->encoder->encodePassword($utilisateur,"12345");
            $utilisateur->setNom('Louss');
            $utilisateur->setEmail("lous@gmail.com");
            $utilisateur->setTelephone("0605928831");
            $utilisateur->setPasse($passeword);
            $manager->persist($utilisateur);
        }
        $manager->flush();
    }
}
