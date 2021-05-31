<?php

namespace App\DataFixtures;

use App\Entity\Posts;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PostFixture extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Posts::class, 10, function(Posts $post, $count) {
            $post->setDescription($this->faker->text)
                ->setImage($this->faker->name);
        });
        $manager->flush();
    }
}
