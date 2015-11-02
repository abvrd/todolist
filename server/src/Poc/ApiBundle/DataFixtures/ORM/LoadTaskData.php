<?php

namespace Poc\ApiBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Poc\ApiBundle\Entity\Task;
use Poc\ApiBundle\Entity\Category;

class LoadTaskData implements FixtureInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        $cat = new Category();
        $cat->setLabel('development');
        $cat->setColor('#01579b');
//        $manager->persist($cat);
//        $manager->flush();
        
        $cat2 = new Category();
        $cat2->setLabel('project');
        $cat2->setColor('#D32F2F');
        $manager->persist($cat2);
        $manager->flush();
        
        $cat3 = new Category();
        $cat3->setLabel('administrative');
        $cat3->setColor('#43A047');
        $manager->persist($cat3);
        $manager->flush();
        
        $cat4 = new Category();
        $cat4->setLabel('life');
        $cat4->setColor('#512DA8');
        $manager->persist($cat4);
        $manager->flush();
        
        $cat5 = new Category();
        $cat5->setLabel('tech');
        $cat5->setColor('#F57C00');
        $manager->persist($cat5);
        $manager->flush();
        
        $cat6 = new Category();
        $cat6->setLabel('miscellaneous');
        $cat6->setColor('#616161');
        $manager->persist($cat6);
        $manager->flush();
        
        $task = new Task();
        $task->setLabel('Développement projet Todo list');
        $task->setDescription('Dev');
        $task->setDate(new \DateTime('now'));
        $task->addCategory($cat);

        $manager->persist($task);
        $manager->flush();
    }

}
