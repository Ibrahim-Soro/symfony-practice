<?php

namespace App\Controller;

use App\Entity\Carousel;
use App\Form\CarouselType;
use App\Repository\CarouselRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/carousel")
 */
class CarouselController extends AbstractController
{
    private $repository;

    private $manager;

    public function __construct(CarouselRepository $repository, ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->repository = $repository;
    }

    /**
     * @Route("/", name="carousel_index", methods={"GET"})
     */
    public function index(): Response
    {
        $carousels = $this->repository->findAll();
        return $this->render('carousel/index.html.twig', [
            'carousels' => $carousels
        ]);
    }

    /**
     * @Route("/new", name="carousel_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $carousel = new Carousel();
        $form = $this->createForm(CarouselType::class, $carousel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($carousel);
            $this->manager->flush();

            return $this->redirectToRoute('carousel_index');
        }

        return $this->render('carousel/new.html.twig', [
            'carousel' => $carousel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carousel_show", methods={"GET"})
     */
    public function show(Carousel $carousel): Response
    {
        return $this->render('carousel/show.html.twig', [
            'carousel' => $carousel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="carousel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Carousel $carousel): Response
    {
        $form = $this->createForm(CarouselType::class, $carousel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();

            return $this->redirectToRoute('carousel_index');
        }

        return $this->render('carousel/edit.html.twig', [
            'carousel' => $carousel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carousel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Carousel $carousel): Response
    {
        if ($this->isCsrfTokenValid('delete' . $carousel->getId(), $request->get('_token'))) {
            $this->manager->remove($carousel);
            $this->manager->flush();
        }

        return $this->redirectToRoute('carousel_index');
    }
}
