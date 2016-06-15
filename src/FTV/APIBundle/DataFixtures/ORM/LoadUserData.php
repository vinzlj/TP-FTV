<?php

namespace FTV\APIBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FTV\APIBundle\Entity\Article;

class LoadUserData implements FixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $article1 = new Article();
        $article1->setTitle('Titre de mon super article');
        $article1->setTeaser('Accroche de mon article');
        $article1->setBody('Domitianum praecipitem per scalas per ampla  raptavere iamque artuum et membrorum.');
        $article1->setCreatedBy('Vincent Le Jeune');

        $article2 = new Article();
        $article2->setTitle('Mon article 2');
        $article2->setTeaser('Accroche de mon article 2');
        $article2->setBody('Saepissime igitur mihi de amicitia cogitanti maxime illud considerandum videri solet.');
        $article2->setCreatedBy('Emmanuel Lemoine');

        $article3 = new Article();
        $article3->setTitle('Mon article 3');
        $article3->setTeaser('Accroche de mon article 3');
        $article3->setBody('Restabat ut Caesar post haec properaret accitus et abstergendae causa sororem suam.');
        $article3->setCreatedBy('Emmanuel Lemoine');

        $manager->persist($article1);
        $manager->persist($article2);
        $manager->persist($article3);

        $manager->flush();
    }

}