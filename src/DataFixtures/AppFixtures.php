<?php

namespace App\DataFixtures;

use App\Entity\Institution;
use App\Entity\Suite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 5; $i++) {
            $institution = new Institution();
            $institution->setName($faker->name());
            $institution->setDescription('description');
            $institution->setCity('city');
            $institution->setAddress('address');
            $manager->persist($institution);

            for ($j = 0; $j < 5; $j++) {
                $suite = new Suite();
                $suite->setName($faker->name());
                $suite->setDescription('description');
                $suite->setPrice($faker->numberBetween($min = 5, $max = 15));
                $suite->setCoverImage('/');
                $suite->setInstitution($institution);
                $manager->persist($suite);
            }
        }

        $manager->flush();
    }
}
