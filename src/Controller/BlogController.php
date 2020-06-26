<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Articles;
use App\Form\CommentType;
use App\Form\ArticlesType;
use App\Form\UploadType;
use App\Repository\ArticlesRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * La methode index :: permet de lister tous les articles de notre blog
     * 
     * @Route("/blog", name="blog")
     */
    public function index(ArticlesRepository $repo)
    {
        $articles = $repo->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            "articles" => $articles
        ]);
    }

    /**
     * la methode home:: représente la page d'accueil de notre blog
     * 
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig', [
            'title' => "Bienvenue sur mon super blog",
            'age' => 20,
        ]);
    }

    /**
     * la methode form :: permet de creer un article puis de les éditer (modifier) si besoin se fait ressentir.
     * 
     * @Route("/blog/new", name="new_article")
     * @Route("/blog/{id}/edit", name="edit_article")
     */
    public function form(Articles $article = null, Request $request, ObjectManager $manager)
    {
        if(!$article){
            $article = new Articles();
        }
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if(!$article->getId()){
                $article->setCreatedAt(new \DateTime());
            }
            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);
        }

        return $this->render("blog/create-article.html.twig", [
            'formArticle' => $form->createView(),
            "editMode" => $article->getId() !== null
        ]);
    }

    /**
     * Methode show :: Permet de visualiser un article et ses caractéristiques.
     *                 Permet également de lister les commentaires d'un article 
     *                 et de commenter un article dans la mésure du possible.
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(Articles $article, Comment $comment, Request $request, ObjectManager $manager)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $comment->setCreatedAt(new \DateTime)
                    ->setArticle($article);

            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('blog_show', [
                'id' => $article->getId()
            ]);
        }
        return $this->render('blog/show.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView()
        ]);
    }
}
