<?php

namespace App\DataFixtures;


use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail($faker->email)
                ->setPassword($faker->password)
                ->setRoles(['ROLE_USER'])
                ->setFirstName($faker->firstName)
                ->setLastName($faker->lastName);

            $manager->persist($user);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
