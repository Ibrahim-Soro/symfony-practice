<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Articles;
use App\Entity\Category;
use App\Entity\Comment;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        // Créé 3 catégories fakées
        for($i = 1; $i <= 3; $i++){
            $category = new Category();
            $category->setTitle($faker->sentence())
                     ->setDescription($faker->paragraph());
            $manager->persist($category);

            // Creer entre 4 ou 6 articles pour chaque catégorie
            for($j = 1; $j <= 10; $j++){
                $article = new Articles();
                $content = '<p>' . join($faker->paragraphs(5), '</p><p>') .'</p>';
                $article->setTitle($faker->sentence())
                        ->setContent($content)
                        ->setImage($faker->imageUrl())
                        ->setCreatedAt($faker->dateTimeBetween('-6 month'))
                        ->setCategory($category);
                $manager->persist($article);

                // On donne des commentaires ? l'article
                for($k = 1; $k <= mt_rand(4, 10); $k++){
                    $comment = new Comment();
                    $days = (new \DateTime())->diff($article->getCreatedAt())->days;
                    $content = '<p>' . join($faker->paragraphs(2), '') . '</p>';
                    $comment->setAuthor($faker->name())
                            ->setContent($content)
                            ->setCreatedAt($faker->dateTimeBetween('-' . $days . 'days'))
                            ->setArticle($article);
                    $manager->persist($comment);
                }
            }
        }

        $manager->flush();
    }
}
