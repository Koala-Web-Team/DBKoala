<?php

namespace App\DataFixtures;

use App\Entity\Courses;
use Doctrine\Persistence\ObjectManager;

class CoursesFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Courses::class, 20, function(Courses $news, $count) {
            $news->setTitle($this->faker->randomElement(['php course','java course' , 'c++ course']))
                ->setDescription($this->faker->text)
            ->setHours($this->faker->randomElement([10,20,30,40,50,60]))
            ->setInstructor($this->faker->name);
        });

        $manager->flush();
    }
}
