<?php

namespace App\DataFixtures;
use App\Entity\News;
use Doctrine\Persistence\ObjectManager;

class NewsFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(News::class, 10, function(News $news, $count) {
           $news->setTitle('who is the killer')
               ->setDescription('we noticed the killer is a very dangerous person 
               who wants to kill every one ');
        });

        $manager->flush();
    }
}
