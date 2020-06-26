<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\Image1Type;
use App\Repository\ImageRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/image")
 */
class ImageController extends AbstractController
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var ImageRepository
     */
    private $repository;
    public function __construct(ObjectManager $manager, ImageRepository $repository)
    {
        $this->manager = $manager;
        $this->repository = $repository;
    }
    /**
     * @Route("/", name="image_index", methods={"GET"})
     */
    public function index(): Response
    {
        $image = $this->repository->findAll();
        return $this->render('image/index.html.twig', [
            'images' => $image,
        ]);
    }

    /**
     * slide
     *
     * @return Response
     * @Route("/image/slide", name="image.slide")
     */
    public function slide(): Response
    {
        $image = $this->repository->findAll();
        return $this->render('image/slide.html.twig', [
            'images' => $image
        ]);
    }

    /**
     * @Route("/new", name="image_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $image = new Image();
        $form = $this->createForm(Image1Type::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($image);
            $this->manager->flush();

            return $this->redirectToRoute('image_index');
        }

        return $this->render('image/new.html.twig', [
            'image' => $image,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="image_show", methods={"GET"})
     */
    public function show(Image $image): Response
    {
        return $this->render('image/show.html.twig', [
            'image' => $image,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="image_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Image $image): Response
    {
        $form = $this->createForm(Image1Type::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();

            return $this->redirectToRoute('image_index');
        }

        return $this->render('image/edit.html.twig', [
            'image' => $image,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="image_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Image $image): Response
    {
        if ($this->isCsrfTokenValid('delete'.$image->getId(), $request->request->get('_token'))) {
            $this->manager->remove($image);
            $this->manager->flush();
        }

        return $this->redirectToRoute('image_index');
    }
}
