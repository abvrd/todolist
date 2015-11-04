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
        
        $cat7 = new Category();
        $cat7->setLabel('professionnal');
        $cat7->setColor('#FFD600');
        $manager->persist($cat7);
        $manager->flush();
        
        $task = new Task();
        $task->setLabel('Développement projet Todo list');
        $task->setDescription('Dev');
        $task->setDate(new \DateTime('now'));
        $task->setDone(new \DateTime('now'));
        $task->addCategory($cat);

        $manager->persist($task);
        $manager->flush();
        
        $task2 = new Task();
        $task2->setLabel('Hire a new developer');
        $task2->setDescription('Have a look at http://site.arnaudbouvard.com');
        $task2->setDate(new \DateTime('now'));
        $task2->addCategory($cat2);
        
        $manager->persist($task2);
        $manager->flush();
        
        $task3 = new Task();
        $task3->setLabel('Call the bank');
        $task3->setDescription('Review my different products.');
        $task3->setDate(new \DateTime('now'));
        $task3->addCategory($cat3);

        $manager->persist($task3);
        $manager->flush();
        
        $task4 = new Task();
        $task4->setLabel('Rdv with customer Carmichael');
        $task4->setDescription('Present new software modules.');
        $task4->setDate(new \DateTime('now'));
        $task4->addCategory($cat7);

        $manager->persist($task4);
        $manager->flush();
    }

}
