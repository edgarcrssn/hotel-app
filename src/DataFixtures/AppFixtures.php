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

        for ($i = 0; $i < 10; $i++) {
            $institution = new Institution();
            $institution->setName($faker->name());
            $institution->setDescription($faker->text(200));
            $institution->setCity($faker->city());
            $institution->setAddress($faker->address());
        }

        for ($i = 0; $i < 10; $i++) {
            $suite = new Suite();
            $suite->setName($faker->name());
            $suite->setDescription($faker->text(100));
            $suite->setPrice($faker->numberBetween($min = 5, $max = 15));
            $suite->setCoverImage($faker->image());
        }

        $manager->persist($institution);
        $manager->persist($suite);

        $manager->flush();
    }
}
