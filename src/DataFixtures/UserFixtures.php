<?php

namespace App\DataFixtures;


namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

;

class UserFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $data = [['rub.attal@gmail.com', "Yehouda", 'Ruben', 'Attal', ['ROLE_ADMIN']], ['mickael.covier15@gmail.com', "AgentK", 'Mickael', 'Covier', ['ROLE_USER']]];

        foreach ($data as $tab) {
            $user = new User();
            $user->setEmail($tab[0]);
            $user->setPassword($this->hasher->hashPassword($user,$tab[1]));
            $user->setPrenom($tab[2]);
            $user->setNom($tab[3]);
            $user->setRoles($tab[4]);

            $manager->persist($user);

        }
        $manager->flush();


    }
}