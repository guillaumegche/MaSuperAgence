<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0; $i < 100; $i++)
        {
            $property = new Property();
            $property->setTitle($faker->words(3, true))
                    ->setDescription($faker->sentences(3, true))
                    ->setSurface($faker->numberBetween(20, 350))
                    ->setRooms($faker->numberBetween(2, 10))
                    ->setBedrooms($faker->numberBetween(2, 9))
                    ->setFlorr($faker->numberBetween(0, 10))
                    ->setPrice($faker->numberBetween(100000, 1000000))
                    ->setHeat($faker->numberBetween(0, count(Property::HEAT) - 1))
                    ->setCity($faker->city)
                    ->setAddress($faker->address)
                    ->setPostalCode($faker->postcode)
                    ->setCountry($faker->country)
                    ->setSold(false)
            ;
            $manager->persist($property);
        }

        $manager->flush();
    }
}
