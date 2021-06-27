<?php

namespace App\DataFixtures;
use App\Entity\Events;
use Doctrine\Persistence\ObjectManager;

class EventsFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Events::class, 10, function(Events $news, $count) {
           $news->setTitle('travelling to the future')
               ->setDescription('The first event for AI and Innovative technology');
        });

        $manager->flush();
    }
}
