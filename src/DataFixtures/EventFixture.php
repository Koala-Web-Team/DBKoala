<?php

namespace App\DataFixtures;

use App\Entity\Events;
use Doctrine\Persistence\ObjectManager;

class EventFixture extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Events::class, 10, function(Events $news, $count) {
            $news->setTitle('travelling to the future')
                ->setDescription($this->faker->text);
        });

        $manager->flush();
    }

}
