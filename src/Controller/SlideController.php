<?php

namespace App\Controller;

use App\Entity\Slide;
use App\Form\SlideType;
use App\Repository\SlideRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SlideController extends AbstractController
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var SlideRepository
     */
    private $repository;

    public function __construct(ObjectManager $manager, SlideRepository $repository)
    {
        $this->manager = $manager;
        $this->repository = $repository;
    }

    /**
     * index
     *
     * @return Response
     * @Route("/slide", name="slide.list")
     */
    public function index():Response
    {
        $slides = $this->repository->findAll();
        return $this->render("slide/index.html.twig", [
            'slides' => $slides
        ]);
    }

    /**
     * create
     *
     * @param  mixed $request
     *
     * @return Response
     * @Route("/slide/create", name="slide.create")
     */
    public function create(Request $request): Response
    {
        $slide = new Slide();
        $form = $this->createForm(SlideType::class, $slide);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($slide);
            $this->manager->flush();

            return $this->redirectToRoute("slide.list");
        }

        return $this->render("slide/create.html.twig", [
            'slide' => $slide,
            'form' => $form->createView()
        ]);
    }

    /**
     * update
     *
     * @param  mixed $slide
     * @param  mixed $request
     *
     * @return Response
     * @Route("/slide/edit/{id}", name="slide.update", methods="POST|GET")
     */
    public function update(Slide $slide, Request $request): Response
    {
        $form = $this->createForm(SlideType::class, $slide);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();

            return $this->redirectToRoute("slide.list");
        }

        return $this->render("slide/update.html.twig", [
            'slide' =>  $slide,
            'form' => $form->createView()
        ]);
    }

    /**
     * delete
     *
     * @param  mixed $slide
     * @param  mixed $request
     *
     * @return Response
     * 
     * @Route("/slide/edit/{id}", name="slide.delete", methods="DELETE")
     */
    public function delete(Slide $slide, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $slide->getId(), $request->get('_token'))) {
            $this->manager->remove($slide);
            $this->manager->flush();
        }
        return $this->redirectToRoute("slide.list");
    }
}
